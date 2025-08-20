<?php

namespace App\Http\Controllers\Customer;
use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Customer\Subscriptions\PlanHistoryService;
use App\Services\Model\OfflinePaymentMethod\OfflinePaymentMethodService;

class PlanHistoryController extends Controller
{
    protected $planHistoryService;

    public function __construct()
    {
        $this->planHistoryService = new PlanHistoryService();
    }

    public function index(Request $request)
    {        
        $data = $this->planHistoryService->index();
        if ($request->ajax()) {
            return view('backend.admin.subscriptions.list-history', $data)->render();
        }

        return view("backend.admin.subscriptions.history")->with($data);
    }
    public function invoice($id)
    {
        $data['history'] = $this->planHistoryService->findById($id);

        return view("backend.admin.subscriptions.invoice")->with($data);
    }
    public function show($id)
    {
        $data['history'] = $this->planHistoryService->findById($id);
        $data["offlinePaymentMethods"]  = (new OfflinePaymentMethodService())->getAll(false, 1);

        return view("backend.admin.payment-request.invoice")->with($data);
    }
    
    public function download($id)
    {
       $data = $this->planHistoryService->downloadData($id);
       $history =  $data['history'];
        return PDF::loadView('backend.admin.subscriptions.download-invoice', $data, [], [])->download($history->id . $history->start_date . '.pdf');
    }
}
