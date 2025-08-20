<?php

namespace App\Models;

use App\Scopes\UserIdScopeTrait;
use App\Traits\Models\User\UserTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRole extends Model
{
    use HasFactory, UserTrait, UserIdScopeTrait;

    protected $table = "user_roles";

    protected $fillable = [
        'role_id', 'user_id'
    ];

    #Relationships
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class,"role_id");
    }
}
