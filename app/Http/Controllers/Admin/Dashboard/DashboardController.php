<?php

namespace App\Http\Controllers\Admin\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\DashboardService;

class DashboardController extends Controller
{
    protected $dashboardService;
    public function __construct()
    {
        $this->middleware('auth');
        $this->dashboardService = new DashboardService();
    }
    // return view page of admin dashboard
    public function index(Request $request)
    {
        $data = $this->dashboardService->index($request);

        return view('home', $data);
    }

    // view page of pages listing
    public function listing()
    {
        return view('pages.listing.list');
    }
}
