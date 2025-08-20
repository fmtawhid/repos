<?php

namespace App\Http\Controllers\Admin\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Model\Reports\ReportService;

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
}
