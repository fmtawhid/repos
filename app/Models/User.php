<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\Models\User\UserTrait;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Notifications\WelcomeNotification;
use App\Traits\Models\Status\IsActiveTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Notifications\EmailVerificationNotification;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Traits\BootTrait\CreatedUpdatedByRelationshipTrait;
use App\Services\Model\SubscriptionPlan\SubscriptionPlanService;
use Modules\BranchModule\App\Models\Branch;

class User extends Authenticatable
{
    use SoftDeletes;
    use HasApiTokens, HasFactory, Notifiable;
    use CreatedByUpdatedByIdTrait, IsActiveTrait;
    use CreatedUpdatedByRelationshipTrait;
    use Billable;

    use UserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "parent_user_id",
        "first_name",
        "last_name",
        "email",
        "mobile_no",
        "user_type",
        "password",
        "avatar",
        "branch_id",
        "subscription_plan_id",
        "verification_code",
        "verification_code_expired_at",
        "email_verified_at",
        "provider_id",
        "provider_type",
        "menu_permission_version",
        "user_balance",
        "referral_code",
        "num_of_clicks",
        "referred_user_id",
        "is_commission_calculated",
        "remember_token",
        "account_status",
        "created_by_id",
        "updated_by_id",
        "deleted_at",
        "stripe_id",
        "pm_type",
        "pm_last_four",
        "trial_ends_at"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
      "full_name",
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'password'   => 'hashed',
    ];

    # email verification notification
    public function sendVerificationNotification()
    {
        $this->notify(new EmailVerificationNotification());
    }

    # registration notification
    public function registrationNotification()
    {
        $this->notify(new WelcomeNotification());
    }

    public function scopeSearch($query, $search) {
        $query = $query->when($search, function($q) use ($search) {
            $q->where(function($newQ) use ($search) {
                $newQ->name($search)
                ->email($search, true, true)
                ->mobile($search, true, true);
            });
        });
    }

    public function scopeName($query, $name) {
        $query->where('first_name', 'like', '%'. $name .'%');
    }

    public function scopeFilters($query)
    {
        $request = request();

        $query->when($request->subscription_plan_id, function($q) use ($request) {
            $q->where('subscription_plan_id', $request->subscription_plan_id);
        });
        $query->when($request->is_active, function($q) use ($request) {
            $q->where('is_active', $request->is_active);
        })->when($request->user_type, function($q) use($request){
            $q->where('user_type', $request->user_type);
        });
        return $query;
    }

    public function scopeEmail($query, $email, $isLike = true, $orWhere = false) {
        $opt = "like"; $val = '%'. $email .'%';
        if(!$isLike) {
            $opt = "="; $val = $email;
        }

        $orWhere ? $query->orWhere('email', $opt, $val) : $query->where('email', $opt, $val);
    }

    public function scopeMobile($query, $mobile_no, $isLike, $orWhere = false) {
        $opt = "like"; $val = '%'. $mobile_no .'%';
        if(!$isLike) {
            $opt = "="; $val = $mobile_no;
        }

        $orWhere ? $query->orWhere('mobile_no', $opt, $val) : $query->where('mobile_no', $opt, $val);
    }

    public function scopeUserType($query, $userType) {
        $query->where("user_type", $userType);
    }

    public function role() : HasOne
    {
        return $this->hasOne(UserRole::class, "user_id")->with("role");
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(SubscriptionPlan::class, "subscription_plan_id", 'id');
    }

    public function histories(): HasMany
    {
        return $this->hasMany(SubscriptionUser::class, "user_id", 'id');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, "user_roles", "user_id", "role_id");
    }

    public function parentUser() : BelongsTo
    {
        return $this->belongsTo(self::class, "parent_user_id");
    }

    public function usage() : HasOne
    {
        return $this->hasOne(SubscriptionUserUsage::class,"user_id")->where('subscription_status', 1);
    }

    public function referredUsers(): HasMany
    {
        return $this->hasMany(self::class, 'referred_user_id', 'id');
    }

    public function referrer() : BelongsTo
    {
        return $this->belongsTo(self::class, "referred_user_id");
    }

    public function userSubscriptionTemplate(): HasMany
    {
        return $this->hasMany(SubscriptionPlanTemplate::class, 'subscription_plan_id', 'subscription_plan_id');
    }

    public function sites() : HasMany
    {
        return $this->hasMany(UserSite::class, 'user_id');
    }

    public function branch(){

        return $this->belongsTo(Branch::class,"branch_id");
    }

}
