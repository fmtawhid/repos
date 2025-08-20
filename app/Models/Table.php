<?php

namespace App\Models;

use App\Traits\Models\Status\IsActiveTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{
    use HasFactory, SoftDeletes, IsActiveTrait;

    protected $fillable = [
        "name",
        "table_code",
        "area_id",
        "number_of_seats",
        "is_active",
        "created_by_id",
        "updated_by_id",
        "deleted_at",
        "qr_code_id"
    ];


    public function qrCode(){
        return $this->belongsTo(QrCode::class);
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }
}
