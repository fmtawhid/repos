<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\Status\IsActiveTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\BootTrait\CreatedUpdatedByRelationshipTrait;

class FAQ extends Model
{
    use HasFactory;
    use IsActiveTrait;
    use CreatedByUpdatedByIdTrait;
    use CreatedUpdatedByRelationshipTrait;
    use SoftDeletes;

    protected $table = "f_a_q_s";

    protected $fillable = [
        "question",
        "answer",
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
            $query->where('question', 'like', '%' . $request->search . '%')->orWhere('answer', 'like', '%' . $request->search . '%');
        }

        return $query;
    }
}
