<?php

namespace Modules\BranchModule\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\BranchModule\Database\factories\BranchMenuFactory;

class BranchMenu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): BranchMenuFactory
    {
        //return BranchMenuFactory::new();
    }
}
