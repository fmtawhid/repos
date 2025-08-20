<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\Status\IsActiveTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\BootTrait\CreatedUpdatedByRelationshipTrait;

class OfflinePaymentMethod extends Model
{
    use HasFactory;
    use SoftDeletes;
    use IsActiveTrait;
    use CreatedByUpdatedByIdTrait;
    use CreatedUpdatedByRelationshipTrait, SoftDeletes;

    protected $table = "offline_payment_methods";

    protected $fillable = [
        "name",
        "description",
        "user_id",
        "created_by_id",
        "updated_by_id",
        "is_active",
        "deleted_at"
    ];

    public function scopeFilters($query)
    {
        $request = request();

        // Search
        if ($request->has("search")) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        return $query;
    }
}
