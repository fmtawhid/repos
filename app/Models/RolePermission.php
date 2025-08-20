<?php

namespace App\Models;

use App\Scopes\UserIdScopeTrait;
use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use App\Traits\BootTrait\CreatedUpdatedByRelationshipTrait;
use App\Traits\Models\User\UserTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RolePermission extends Model
{
    use HasFactory;
    use UserTrait;
    use UserIdScopeTrait;
    use CreatedUpdatedByRelationshipTrait;
    
    protected $table = "role_permissions";
    protected $fillable = [
        "permission_id",
        "role_id",
        "user_id",
        "created_by_id",
        "updated_by_id",
        "deleted_at"
    ];

    #Relationships

    #Role
    public function role() : BelongsTo
    {
        return $this->belongsTo(Role::class,"role_id")->withTrashed();
    }

    #Permission
    public function permission() : BelongsTo
    {
        return $this->belongsTo(Permission::class,"permission_id")->withTrashed();
    }
}
