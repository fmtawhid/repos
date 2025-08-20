<?php

namespace App\Traits\Merchant;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait MerchantTrait
{

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class,"user_id")->withTrashed();
    }

    public function merchant() : BelongsTo
    {
        return $this->belongsTo(User::class,"user_id");
    }

    public function parent() : BelongsTo
    {
        return $this->belongsTo(User::class,"parent_user_id");
    }

    public function productOwner() : BelongsTo
    {
        return $this->belongsTo(User::class,"product_owner_id");
    }
}
