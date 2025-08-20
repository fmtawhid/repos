<?php

namespace App\Traits\Models\User;

use App\Models\ItemCategory;
use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Modules\BranchModule\App\Models\Branch;
use Modules\CartManager\App\Models\Cart;
use Modules\TransactionManager\App\Models\Transaction;
use App\Models\SubscriptionUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserTrait
{


    #Relationships
    public function merchant() : BelongsTo {
        return $this->belongsTo(User::class,"parent_user_id");
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class,"user_id");
    }

    public function parent() : BelongsTo
    {
        return $this->belongsTo(User::class,"parent_user_id");
    }

    public function roles() : BelongsToMany
    {
        return $this->belongsToMany(Role::class,"user_roles");
    }

    # My Carts Items
    public function myCarts() : HasMany{
        return $this->hasMany(Cart::class,"user_id");
    }

    public function orders()
    {
        return $this->hasMany(Order::class,'customer_id');
    }

    function totalDelivered(){
        return $this->orders()->completed()->count();
    }

    function totalPending(){
        return $this->orders()->pending()->count();
    }

    function totalCanceled(){
        return $this->orders()->canceled()->count();
    }

    function totalDeclined(){
        return $this->orders()->declined()->count();
    }

//    public function subscriptions() : HasMany
//    {
//        return $this->hasMany(SubscriptionUser::class,"user_id");
//    }

    public function validSubscriptions() : HasMany
    {
        return $this->hasMany(SubscriptionUser::class)
            ->latest()->expireDate(now(), '>=');
    }

    public function products() : HasMany
    {
        return $this->hasMany(Product::class,"product_owner_id");
    }

    public function merchantMemberProducts() : HasMany
    {
        return $this->hasMany(Product::class,"created_by_id");
    }


    public function categories() : HasMany
    {
        return $this->hasMany(ItemCategory::class,"user_id");
    }


    public function shop()
    {
        return $this->belongsTo(Branch::class,"branch_id");
    }

    public function transactions():HasMany{
        return $this->hasMany(Transaction::class,"user_id");
    }


    /**
     * #############################################
     * #####          Scopes Area Start        #####
     * #############################################
     * */
    public function scopeUserType($query, $user_type = null): void
    {
        $user_type = (empty($user_type)) ? getUserType() : $user_type;
        $query->where("user_type",$user_type);
    }


    public function scopeMerchantId($query, $user_id = null)
    {
        $user_id = empty($user_id) ? merchantId() : $user_id;

        $query->where("user_id",$user_id);
    }


    public function scopeFilters($query)
    {
        $request = request();

        // when search is found
        if($request->has("search") && !is_null($request->search)){
            $query->where(function($query) use ($request){
                $query->where("first_name","like","%$request->search%")
                    ->orWhere("last_name","like","%$request->search%")
                    ->orWhere("email","like","%$request->search%");
            });
        }

        // when country is found
        if($request->has("country_id") && !is_null($request->country_id)){
            $query->where("country_id",$request->country_id);
        }

        // when user type is found
        if($request->has("user_type") && !is_null($request->user_type)){
            $query->where("user_type",$request->user_type);
        }

        //when status is found
        if ($request->has("status") && !is_null($request->status)) {
            $query->where("account_status", $request->status);
        }

        //top merchant
        if ($request->has("top_merchant") && ($request->top_merchant == true) ) {
            $query->where("review_avg", '>', 0)->orderBy("review_avg", "desc");
        }
    }

    /**
     * #############################################
     * #####          Scopes Area End          #####
     * #############################################
     * */


}
