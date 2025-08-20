<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\FrontendService;
use Illuminate\Http\Request;
use Modules\PosManager\Services\Business\PosOrderService;

class HomeController extends Controller
{
    protected $frontendService;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __construct()
    {
        $this->frontendService = new FrontendService();
    }
    public function index()
    {
        return view('welcome');
    }

    public function printInvoice($id)
    {
        $order = (new PosOrderService())->getOrderById($id);

        $data["order"]  = $order;
        $data["branch"] = $order->branch;

        return view("backend.admin.invoices.index")->with($data);
    }
}
