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

    public function itemCategoryReports(){
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

        return $query->paginate(maxPaginateNo() ?? 10);
    }


    public function itemReports()
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

        return $query->paginate(maxPaginateNo() ?? 10);
    }


    public function salesReports(){
        $data = [];
        $data['salesReports'] = [];
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
    


    public function subscriptions()
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

        $data['histories']  = $histories->paginate(maxPaginateNo());

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
        
        $data['reservations'] = (new ReservationService())->getReservationReports();

        return $data;
    }

    # teamsReports 
    public function teamsReports(){
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
       
        $data['users'] = (new UserService())->getUsersForReport($query);

        return $data;
    }
}