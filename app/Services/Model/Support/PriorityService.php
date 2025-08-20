<?php

namespace App\Services\Model\Support;

use App\Models\SupportPriority;

class PriorityService
{

    public function getAll(
        $isPaginateGetOrPluck = null,
        $onlyActives = null,
        $withRelationships = ["updatedBy", "createdBy"])
    {

        $query = SupportPriority::query()->filters()->orderBy('id', 'DESC');

        // Bind Relationships
        (!empty($withRelationships) ? $query->with($withRelationships) : false);

        if(!is_null($onlyActives)){
            $query->isActive($onlyActives);
        }

        if (is_null($isPaginateGetOrPluck)) {
            return $query->pluck("name", "id");
        }

        return $isPaginateGetOrPluck ? $query->paginate(maxPaginateNo()) : $query->get();
    }
    public function findSupportPriorityById($id, $withRelationships = [], $conditions = [])
    {
        $query = SupportPriority::query();

        // Bind Relationships
        !empty($withRelationships) ? $query->with($withRelationships) : false;

        return $query->findOrFail($id);
    }

    public function store(array $payloads)
    {
        return SupportPriority::query()->create($payloads);
    }

    public function update(object $templateCategory, array $payloads)
    {
        $templateCategory->update($payloads);

        return $templateCategory;
    }

}

