<?php

namespace App\Traits\Relationship;

use Modules\BranchModule\App\Models\Branch;

trait BranchRelationshipTrait
{
    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'branch_menus');
    }
}
