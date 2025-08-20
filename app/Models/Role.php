<?php

namespace App\Models;

use App\Scopes\UserIdScopeTrait;
use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use App\Traits\BootTrait\CreatedUpdatedByRelationshipTrait;
use App\Traits\Models\User\UserTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stripe\ApiOperations\Create;

class Role extends Model
{
    use HasFactory;
    use UserIdScopeTrait;
    use CreatedByUpdatedByIdTrait;
    use CreatedUpdatedByRelationshipTrait;
    use UserTrait;
    use SoftDeletes;

    protected $table = "roles";
    protected $fillable = [
        "is_active",
        "name",
        "user_id",
        "created_by_id",
        "updated_by_id",
        "deleted_at"
    ];

    #Relationships
    public function permissions() : BelongsToMany
    {
        return $this->belongsToMany(Permission::class,"role_permissions");
    }

    # Role Permissions
    public function rolePermissions() : HasMany
    {
        return $this->hasMany(RolePermission::class,"role_id");
    }

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class,"user_roles","role_id","user_id");
    }
}
