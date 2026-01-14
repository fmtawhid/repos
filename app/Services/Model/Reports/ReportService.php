<?php
namespace App\Services\Model\Reports;

use App\Models\Product;
use App\Models\User;
use App\Services\Model\User\UserService;
use Illuminate\Support\Str;
use App\Models\SubscriptionUser;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Carbon;
use Modules\BranchModule\App\Models\Branch;
use Modules\BranchModule\App\Services\BranchService;
use Modules\ReservationManager\App\Models\Reservation;
use Modules\ReservationManager\App\Services\Reservation\ReservationService;

class ReportService 
{

    public function itemCategoryReports($export = false){
        $date_range = request()->date_range ?? null;
        $query = Product::query()
            ->filters()
            ->with('itemCategory')
            ->selectRaw('item_category_id, sum(order_products.qty) as total_quantity, sum(order_products.price * order_products.qty) as total_price')
            ->join('order_products', 'order_products.product_id', '=', 'products.id')
            ->groupBy('item_category_id');

        if ($date_range) {
            $dates = explode(' to ', $date_range);
            $query->whereBetween('order_products.created_at', [
                Carbon::createFromFormat('m/d/Y', $dates[0])->startOfDay(),
                Carbon::createFromFormat('m/d/Y', $dates[1])->endOfDay(),
            ]);
        }

        if ($export) {
            return $query->get();
        }

        return $query->paginate(maxPaginateNo() ?? 10);
    }


    public function itemReports($export = false)
    {
        $date_range = request()->date_range ?? null;

        $query = Product::query()
            ->filters()
            ->selectRaw('products.name as item_name, products.item_category_id, SUM(order_products.qty) as quantity_sold, SUM(order_products.sub_total) as total_income, SUM(order_products.price) as selling_price')
            ->join('order_products', 'order_products.product_id', '=', 'products.id');

        if ($date_range) {
            $dates = explode(' to ', $date_range);
            $query->whereBetween('order_products.created_at', [date('Y-m-d', strtotime($dates[0])), date('Y-m-d', strtotime($dates[1]))]);
        }

        $query->groupBy('products.name', 'products.item_category_id')
            ->orderBy('total_income', 'DESC');

        if ($export) {
            return $query->get();
        }

        return $query->paginate(maxPaginateNo() ?? 10);
    }


    public function salesReports($export = false){
        $date_range = request()->date_range ?? null;

        // If a vendor_id is provided or detailed/per_product flag is set, return per-order-product rows
        $detailed = request()->get('per_product', false) || request()->get('detailed', false) || request()->has('vendor_id');

        if ($detailed) {
            // use appropriate customer name column depending on schema
            $customerNameSelect = (\Illuminate\Support\Facades\Schema::hasColumn('users', 'name'))
                ? "customers.name as customer_name"
                : "CONCAT(COALESCE(customers.first_name,''),' ',COALESCE(customers.last_name,'')) as customer_name";

            $query = \App\Models\Order::query()
                ->join('order_products', 'order_products.order_id', '=', 'orders.id')
                ->leftJoin('products', 'products.id', '=', 'order_products.product_id')
                ->leftJoin('users as customers', 'customers.id', '=', 'orders.customer_id')
                ->selectRaw('orders.id as order_id, orders.invoice_no, orders.created_at as date, orders.total as order_total, orders.discount_value, orders.paid_amount, orders.payment_method, order_products.product_id, products.name as product_name, order_products.qty as product_qty, order_products.sub_total as product_sub_total, ' . $customerNameSelect)
                ->orderBy('orders.created_at', 'DESC');

            if ($date_range) {
                $dates = explode(' to ', $date_range);
                $query->whereBetween('orders.created_at', [
                    \Illuminate\Support\Carbon::createFromFormat('m/d/Y', $dates[0])->startOfDay(),
                    \Illuminate\Support\Carbon::createFromFormat('m/d/Y', $dates[1])->endOfDay(),
                ]);
            }

            if (request()->has('vendor_id') && request('vendor_id') != null) {
                $query->where('orders.vendor_id', request('vendor_id'));
            }

            if (request()->has('branch_id') && request('branch_id') != null) {
                $query->where('orders.branch_id', request('branch_id'));
            }

            if (request()->has('status_id') && request('status_id') != null) {
                $query->where('orders.status_id', request('status_id'));
            }

            if ($export) {
                $data['salesReports'] = $query->get();
            } else {
                $data['salesReports'] = $query->paginate(maxPaginateNo() ?? 10);
            }

            return $data;
        }

        // default grouped-by-date summary
        $query = \App\Models\Order::query()
            ->leftJoin('order_products', 'order_products.order_id', '=', 'orders.id')
            ->selectRaw("DATE(orders.created_at) as date, COUNT(DISTINCT orders.id) as total_orders, SUM(order_products.qty) as total_items, SUM(orders.total) as total_amount, SUM(orders.discount_value) as total_discount, SUM(orders.paid_amount) as total_paid, GROUP_CONCAT(DISTINCT orders.payment_method SEPARATOR ', ') as payment_methods")
            ->groupBy('date')
            ->orderBy('date', 'DESC');

        // manual filters (date_range, branch, status) since Order model may not have scopeFilters
        if ($date_range) {
            $dates = explode(' to ', $date_range);
            $query->whereBetween('orders.created_at', [
                \Illuminate\Support\Carbon::createFromFormat('m/d/Y', $dates[0])->startOfDay(),
                \Illuminate\Support\Carbon::createFromFormat('m/d/Y', $dates[1])->endOfDay(),
            ]);
        }

        if (request()->has('branch_id') && request('branch_id') != null) {
            $query->where('branch_id', request('branch_id'));
        }

        if (request()->has('status_id') && request('status_id') != null) {
            $query->where('status_id', request('status_id'));
        }

        $data = [];
        if ($export) {
            $data['salesReports'] = $query->get();
        } else {
            $data['salesReports'] = $query->paginate(maxPaginateNo() ?? 10);
        }

        return $data;
    }


    public function getTempUserId()
    {
        $request = request();

        if($request->has("user_id") && !empty($request->user_id)){
            return $request->user_id; //TODO::When logged in user is not Admin, We must verify the user_id is belongs to the logged in user parent or not. Will implement Later.
        }

        if(!isAdmin()){
            return getUserParentId();
        }

        return null;
    }
    


    public function subscriptions($export = false)
    {
        $data = [];
        $request = request();
        $searchKey = null;

        $userId = $this->getTempUserId();

        //TODO:: Refactor Required based on our standard
        $histories = SubscriptionUser::latest()->when($userId, function($q) use($userId){
            $q->where('user_id', $userId);
        })->when($request->package_id, function($q) use($request){
            $q->where('subscription_plan_id', $request->package_id);
        });

        if ($request->search != null) {

            $userIds = User::query()->when(!isAdmin(), function ($q) use($request){
                $q->where('parent_user_id', userID());
            })->where('name', 'like', '%' . $request->search . '%')->pluck('id');

            $histories = $histories->whereIn('user_id', $userIds);

            $searchKey = $request->search;
        }

        # conditional   
        if (Str::contains($request->date_range, 'to') && $request->date_range != null) {
            $date_var = explode(" to ", $request->date_range);
        } else {
            $date_var = [date("d-m-Y", strtotime('7 days ago')), date("d-m-Y", strtotime('today'))];
        }

        $histories = $histories->where('created_at', '>=', date("Y-m-d", strtotime($date_var[0])))->where('created_at', '<=',  date("Y-m-d", strtotime($date_var[1]) + 86400000));

        $data['totalPrice'] = $histories->sum('price');

        if ($export) {
            $data['histories'] = $histories->get();
        } else {
            $data['histories']  = $histories->paginate(maxPaginateNo());
        }

        $data['users']      = $this->users();
        $data['user_id']    = $request->user_id;
        $data['package_id'] = $request->package_id;

        //TODO:: Refactor Required based on our standard
        $data['packages']   = SubscriptionPlan::get(['id', 'title']);

        return $data;
    }

    public function users($userId = null)
    {

        return (new UserService())->getUsersByUserId($userId);
    }

    # reservation reports
    public function reservationsReports(){
        $data = [];
        
        if (isVendor()) {
            $data['branches'] = (new BranchService())->getBranchesByVendorId(userID());
        }else{
            $data['branches'] = (new BranchService())->getBranchesByUserBranchId(user()->branch_id);
        }
        
        $data['reservations'] = (new ReservationService())->getReservationReports(false, request()->get('export', false));

        return $data;
    }

    # teamsReports 
    public function teamsReports($export = false){
        $data = [];
        
        if (isVendor()) {
            $data['branches'] = (new BranchService())->getBranchesByVendorId(userID());
        }else{
            $data['branches'] = (new BranchService())->getBranchesByUserBranchId(user()->branch_id);
        }
        
        if (isVendorUserGroup()) {
            $query      = (new UserService())->getVendorTeamQuery(); 
        }else{
            $query      = (new UserService())->getAdminStaffQuery(); 
        }
       
        $data['users'] = (new UserService())->getUsersForReport($query, $export);

        return $data;
    }
}