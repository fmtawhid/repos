<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    use HasFactory;

    protected $table = 'qr_codes';
    
    protected $fillable = [
        'id',
        'title',
        'code',
        'created_at',
        'updated_at'
    ];


    public function table(){
        return $this->hasOne(Table::class);
    }
}