<?php

namespace Modules\ReservationManager\App\Models;

use App\Models\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\ReservationManager\Database\factories\ReservationTableFactory;

class ReservationTable extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'reservation_id',
        'table_id',
    ];
    

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

}
