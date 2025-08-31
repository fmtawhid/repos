<?php

namespace App\Services\Dashboard;

use App\Models\ItemCategory;
use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use App\Models\SystemSetting;
use Illuminate\Support\Facades\Auth;

class DashboardService {

    // get data for dashboard
    public function index($request) :array
    {
        $vendorId = Auth::id(); // লগিনকৃত vendor এর ID
        
        $data                      = [];
        $data['timelineText']      = $this->timelineText($request->timeline);
        $data['totalEarning']      = $this->totalEarnings($vendorId);
        $data['totalSalesData']    = $this->totalSalesChart($request->timeline, $vendorId);
        $data['totalCatSalesData'] = $this->topFiveCategoryChart($vendorId);
        $data['totalOrdersData']   = $this->last30DaysOrderChart($vendorId);
        $data['thisMonthSaleData'] = $this->thisMonthSaleChart($vendorId);

        $orderCounts = $this->orderCounts($vendorId);
        $data['totalOrderCount']      = $orderCounts['totalOrderCount'];
        $data['pendingOrderCount']    = $orderCounts['pendingOrderCount'];
        $data['processingOrderCount'] = $orderCounts['processingOrderCount'];
        $data['completedOrderCount']  = $orderCounts['completedOrderCount'];

        return $data;
    }

    # orderCount
    public function orderCounts($vendorId) { 
        return [
            'totalOrderCount'      => Order::where('vendor_id', $vendorId)->count(),
            'pendingOrderCount'    => Order::where('vendor_id', $vendorId)
                                        ->where('status_id', appStatic()::STATUS_ID['PENDING'])->count(),
            'processingOrderCount' => Order::where('vendor_id', $vendorId)
                                        ->where('status_id', appStatic()::STATUS_ID['HOLD'])->count(),
            'completedOrderCount'  => Order::where('vendor_id', $vendorId)
                                        ->where('status_id', appStatic()::STATUS_ID['COMPLETED'])->count(),
        ];
    }

    # totalEarnings
    public function totalEarnings($vendorId) { 
        return OrderProduct::whereHas('order', function($query) use ($vendorId) {
                    $query->where('vendor_id', $vendorId)
                          ->where('status_id', '!=', appStatic()::STATUS_ID['CANCELLED']);
                })->sum('total_price');
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
    public function totalSalesChart($time, $vendorId)
    {
        $timeline = 7; // 7, 30 or 90 days 

        if ((int)$time > 7) {
            $timeline = (int) $time;
        }

        $orderProducts = OrderProduct::whereHas('order', function($query) use ($vendorId, $timeline) {
                            $query->where('vendor_id', $vendorId)
                                  ->where('status_id', '!=', appStatic()::STATUS_ID['CANCELLED'])
                                  ->where('created_at', '>=', Carbon::now()->subDays($timeline));
                        })->oldest()->get();

        $totalSalesTimelineInString = '';
        $totalSalesAmountInString   = '';

        for ($i = $timeline; $i >= 0; $i--) {
            $totalSalesAmount = 0;
            foreach ($orderProducts as $orderProduct) {
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

        $totalSalesData               = new SystemSetting;
        $totalSalesData->labels       = $totalSalesTimelineInString;
        $totalSalesData->amount       = $totalSalesAmountInString;
        $totalSalesData->totalEarning = $orderProducts->sum('total_price');

        return $totalSalesData;
    }

    # top 5 category chart
    public function topFiveCategoryChart($vendorId)
    {
        $categories = ItemCategory::where('vendor_id', $vendorId)
                        ->orderBy('total_sales_count', 'DESC')
                        ->take(5);
        
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

        $totalCatSalesData                          = new SystemSetting;
        $totalCatSalesData->totalCategorySalesCount = $totalCategorySalesCount;
        $totalCatSalesData->series                  = json_encode($catSeries);
        $totalCatSalesData->labels                  = $catLabelsInString;

        return $totalCatSalesData;
    }

    # last 30 days order
    public function last30DaysOrderChart($vendorId)
    {
        $timelineOrder                    = 30;
        $totalOrdersTimelineInString      = '';
        $totalOrdersAmountInString        = '';
        
        $orders = Order::where('vendor_id', $vendorId)
                    ->where('created_at', '>=', Carbon::now()->subDays($timelineOrder))
                    ->oldest()
                    ->get();

        for ($j = $timelineOrder; $j >= 0; $j--) {
            $totalOrdersAmount = 0;

            foreach ($orders as $order) {
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

        $totalOrdersData              = new SystemSetting;
        $totalOrdersData->labels      = $totalOrdersTimelineInString;
        $totalOrdersData->amount      = $totalOrdersAmountInString;
        $totalOrdersData->totalOrders = $orders->count();

        return $totalOrdersData;
    }

    # this month sale's chart
    private function thisMonthSaleChart($vendorId)
    {
        $monthStart = Carbon::now()->startOfMonth();
        
        $orderProducts = OrderProduct::whereHas('order', function($query) use ($vendorId, $monthStart) {
                            $query->where('vendor_id', $vendorId)
                                  ->where('status_id', '!=', appStatic()::STATUS_ID['CANCELLED'])
                                  ->where('created_at', '>=', $monthStart);
                        })->get();

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
            foreach ($orderProducts as $orderProduct) {
                if ($date == date('Y-m-d', strtotime($orderProduct->created_at))) {
                    $totalOrdersAmount += $orderProduct->total_price;
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
        
        $thisMonthSaleData         = new SystemSetting;
        $thisMonthSaleData->labels = $thisMonthTimelineInString;
        $thisMonthSaleData->amount = $thisMonthAmountInString;
        $thisMonthSaleData->totalEarning = $orderProducts->sum('total_price');
        
        return $thisMonthSaleData;
    }
}