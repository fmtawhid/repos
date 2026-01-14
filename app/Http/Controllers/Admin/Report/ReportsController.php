<?php

namespace App\Http\Controllers\Admin\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Model\Reports\ReportService;
// use Barryvdh\DomPDF\Facade\Pdf;
use niklasravnsborg\LaravelPdf\Facades\Pdf;


class ReportsController extends Controller
{
    protected $reportService;

    public function __construct()
    {
        $this->reportService = new ReportService();        
    }

    public function itemReports(Request $request)
    {
        try {
            $data['items'] = $this->reportService->itemReports();

            if ($request->ajax()) {
                return view('backend.admin.reports.render.items-list', $data)->render();
            }
            return view('backend.admin.reports.items', $data);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function itemCategoryReports(Request $request)
    {
        try {
            $data['item_categories'] = $this->reportService->itemCategoryReports();

            if ($request->ajax()) {
                return view('backend.admin.reports.render.item-category', $data)->render();
            }
            return view('backend.admin.reports.item-category', $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function salesReports(Request $request)
    {
        try {
            // default to detailed/per-product view unless explicitly disabled
            $request->merge(['per_product' => $request->get('per_product', true)]);

            $data = $this->reportService->salesReports();
            if ($request->ajax()) {
                return view('backend.admin.reports.render.sales-list', $data)->render();
            }
            return view('backend.admin.reports.sales', $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function subscriptionReports(Request $request)
    {
        try {
            $data = $this->reportService->subscriptions();
            if ($request->ajax()) {
                return view('backend.admin.reports.render.subscriptions-list', $data)->render();
            }
            return view('backend.admin.reports.subscriptions', $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    # reservationReports
    public function reservationsReports(Request $request)
    {
        try {
            $data = $this->reportService->reservationsReports();
            if ($request->ajax()) {
                return view('backend.admin.reports.render.reservation-list', $data)->render();
            }
            return view('backend.admin.reports.reservations', $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    # teamsReports
    public function teamsReports(Request $request)
    {
        try {
            $data = $this->reportService->teamsReports();
            if ($request->ajax()) {
                return view('backend.admin.reports.render.teams-list', $data)->render();
            }
            return view('backend.admin.reports.teams', $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function exportItemsPdf(Request $request)
    {
        try {
            $data['items'] = $this->reportService->itemReports(true);

            $pdf = Pdf::loadView('backend.admin.reports.pdf.items', $data);
            return $pdf->download('items-report.pdf');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function exportItemCategoryPdf(Request $request)
    {
        try {
            $data['item_categories'] = $this->reportService->itemCategoryReports(true);
            $pdf = Pdf::loadView('backend.admin.reports.pdf.item-category', $data);
            return $pdf->download('item-categories-report.pdf');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function exportSalesPdf(Request $request)
    {
        try {
            // ensure export uses detailed/per-product view by default
            $request->merge(['per_product' => $request->get('per_product', true)]);

            $data = $this->reportService->salesReports(true);
            $pdf = Pdf::loadView('backend.admin.reports.pdf.sales', $data);
            return $pdf->download('sales-report.pdf');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function exportSubscriptionsPdf(Request $request)
    {
        try {
            $data = $this->reportService->subscriptions(true);
            $pdf = Pdf::loadView('backend.admin.reports.pdf.subscriptions', $data);
            return $pdf->download('subscriptions-report.pdf');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function exportReservationsPdf(Request $request)
    {
        try {
            $request->merge(['export' => true]);
            $data = $this->reportService->reservationsReports();
            $pdf = Pdf::loadView('backend.admin.reports.pdf.reservations', $data);
            return $pdf->download('reservations-report.pdf');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function exportTeamsPdf(Request $request)
    {
        try {
            $data = $this->reportService->teamsReports(true);
            $pdf = Pdf::loadView('backend.admin.reports.pdf.teams', $data);
            return $pdf->download('teams-report.pdf');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
