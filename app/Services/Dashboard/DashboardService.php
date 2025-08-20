<?php

namespace App\Services\Dashboard;

use App\Models\ItemCategory;
use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use App\Models\SystemSetting;
class DashboardService {

    // get data for dashboard
    public function index($request) :array
    {
        $data                      = [];
        $data['timelineText']      = $this->timelineText($request->timeline);
        $data['totalEarning']      = $this->totalEarnings();
        $data['totalSalesData']    = $this->totalSalesChart($request->timeline);
        $data['totalCatSalesData'] = $this->topFiveCategoryChart();
        $data['totalOrdersData']   = $this->last30DaysOrderChart();
        $data['thisMonthSaleData'] = $this->thisMonthSaleChart();

        $data['totalOrderCount']      = $this->orderCounts()['totalOrderCount'];
        $data['pendingOrderCount']    = $this->orderCounts()['pendingOrderCount'];
        $data['processingOrderCount'] = $this->orderCounts()['processingOrderCount'];
        $data['completedOrderCount']  = $this->orderCounts()['completedOrderCount'];

        return $data;
    }

    # orderCount
    public function orderCounts() { 
        return [
            'totalOrderCount'      => Order::count(),
            'pendingOrderCount'    => Order::where('status_id', appStatic()::STATUS_ID['PENDING'])->count(),
            'processingOrderCount' => Order::where('status_id', appStatic()::STATUS_ID['HOLD'])->count(),
            'completedOrderCount'  => Order::where('status_id', appStatic()::STATUS_ID['COMPLETED'])->count(),
        ];
    }

    # totalEarnings
    public function totalEarnings() { 
        $orderProductIds = OrderProduct::where('status_id', '!=', appStatic()::STATUS_ID['CANCELLED'])->pluck('id');
        return OrderProduct::whereIn('id', $orderProductIds)->sum('total_price');
    }

    # timeline text
    public function timelineText($time)
    {
        $timeline                   = 7; // 7, 30 or 90 days
        $timelineText               = localize('Last 7 days');

        if ((int)$time > 7) {
            $timeline = (int) $time;

            if ($timeline == 30) {
                $timelineText               = localize('Last 30 days');
            } else {
                $timelineText               = localize('Last 3 months');
            }
        }

        return $timelineText;
    }
     
    # total sales chart
    public function totalSalesChart($time)
    {
        $timeline = 7; // 7, 30 or 90 days 

        if ((int)$time > 7) {
            $timeline = (int) $time;
        }

        $orderProductIds            = OrderProduct::where('status_id', '!=', appStatic()::STATUS_ID['CANCELLED'])->where('created_at', '>=', Carbon::now()->subDays($timeline))->pluck('id');
        $orderProductQueries        = OrderProduct::whereIn('id', $orderProductIds)->oldest();
        $totalSalesTimelineInString = '';
        $totalSalesAmountInString   = '';

        for ($i = $timeline; $i >= 0; $i--) {
            $totalSalesAmount = 0;
            foreach ($orderProductQueries->get() as $orderProduct) {
                if (date('Y-m-d', strtotime($i . ' days ago')) == date('Y-m-d', strtotime($orderProduct->created_at))) {
                    $totalSalesAmount += $orderProduct->total_price;
                }
            }
            if ($i == 0) {
                $totalSalesTimelineInString .= json_encode(date('Y-m-d', strtotime($i . ' days ago')));
                $totalSalesAmountInString .= json_encode($totalSalesAmount);
            } else {
                $totalSalesTimelineInString .= json_encode(date('Y-m-d', strtotime($i . ' days ago'))) . ',';
                $totalSalesAmountInString .= json_encode($totalSalesAmount) . ',';
            }
        }

        $totalSalesData               = new SystemSetting; // to create temp instance.
        $totalSalesData->labels       = $totalSalesTimelineInString;
        $totalSalesData->amount       = $totalSalesAmountInString;
        $totalSalesData->totalEarning = $orderProductQueries->sum('total_price');

        return $totalSalesData;
    }

    # top 5 category chart
    public function topFiveCategoryChart()
    {
        $categories              = ItemCategory::orderBy('total_sales_count', 'DESC')->take(5);
        $totalCategorySalesCount = $categories->sum('total_sales_count');
        $catLabelsInString       = '';
        $catSeries               = [];

        foreach ($categories->get() as $key => $cat) {
            $catLabelsInString .= json_encode($cat->name);
            if ($key + 1 != 5) {
                $catLabelsInString .= ',';
            }
            array_push($catSeries, (float) $cat->total_sales_count);
        }

        $totalCatSalesData                          = new SystemSetting; // to create temp instance.
        $totalCatSalesData->totalCategorySalesCount = $totalCategorySalesCount;
        $totalCatSalesData->series                  = json_encode($catSeries);
        $totalCatSalesData->labels                  = $catLabelsInString;

        return $totalCatSalesData;
    }

    # last 30 days order
    public function last30DaysOrderChart()
    {
        $timelineOrder                    = 30; // 7, 30 or 90 days   
        $totalOrdersTimelineInString      = '';
        $totalOrdersAmountInString        = '';
        $ordersQuery = Order::where('created_at', '>=', Carbon::now()->subDays($timelineOrder))->oldest();

        for ($j = $timelineOrder; $j >= 0; $j--) {
            $totalOrdersAmount = 0;

            foreach ($ordersQuery->get() as $order) {
                if (date('Y-m-d', strtotime($j . ' days ago')) == date('Y-m-d', strtotime($order->created_at))) {
                    $totalOrdersAmount += 1;
                }
            }

            if ($j == 0) {
                $totalOrdersTimelineInString .= json_encode(date('Y-m-d', strtotime($j . ' days ago')));
                $totalOrdersAmountInString .= json_encode($totalOrdersAmount);
            } else {
                $totalOrdersTimelineInString .= json_encode(date('Y-m-d', strtotime($j . ' days ago'))) . ',';
                $totalOrdersAmountInString .= json_encode($totalOrdersAmount) . ',';
            }
        }

        $totalOrdersData              = new SystemSetting;             // to create temp instance.
        $totalOrdersData->labels      = $totalOrdersTimelineInString;
        $totalOrdersData->amount      = $totalOrdersAmountInString;
        $totalOrdersData->totalOrders = $ordersQuery->count();

        return $totalOrdersData;
    }

    # this month sale's chart
    private function thisMonthSaleChart()
    {
        $monthStart                = Carbon::now()->startOfMonth();
        $orderProductIds           = OrderProduct::where('status_id', '!=', appStatic()::STATUS_ID['CANCELLED'])->where('created_at', '>=', $monthStart)->pluck('id');
        $orderThisMonthQuery       = Order::whereIn('id', $orderProductIds)->oldest();
        $thisMonthTimelineInString = '';
        $thisMonthAmountInString   = '';

        $today = today();
        $dates = [];
        $datesReadable = [];
        for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
            $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
            $datesReadable[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('d M');
        }
        foreach ($dates as $key => $date) {
            $totalOrdersAmount = 0;
            foreach ($orderThisMonthQuery->get() as $orderGroup) {
                if ($date == date('Y-m-d', strtotime($orderGroup->created_at))) {
                    $totalOrdersAmount += $orderGroup->total;
                }
            }

            if ($key == count($dates) - 1) {
                $thisMonthTimelineInString .= json_encode($datesReadable[$key]);
                $thisMonthAmountInString .= json_encode($totalOrdersAmount);
            } else {
                $thisMonthTimelineInString .= json_encode($datesReadable[$key]) . ',';
                $thisMonthAmountInString .= json_encode($totalOrdersAmount) . ',';
            }
        }
        $thisMonthSaleData         = new SystemSetting; // to create temp instance.
        $thisMonthSaleData->labels =  $thisMonthTimelineInString;
        $thisMonthSaleData->amount = $thisMonthAmountInString;
        $thisMonthSaleData->totalEarning = $orderThisMonthQuery->sum('total');
        return $thisMonthSaleData;
    }
}
