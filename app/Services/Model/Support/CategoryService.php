<?php

namespace App\Services\Model\Support;

use App\Models\SupportCategory;

class CategoryService
{

    public function getAll(
        $isPaginateGetOrPluck = null,
        $onlyActives = null,
        $withRelationships = ["updatedBy", "createdBy"])
    {

        $query = SupportCategory::query()->filters()->orderBy('id', 'DESC');

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
    public function findSupportCategoryById($id, $withRelationships = [], $conditions = [])
    {
        $query = SupportCategory::query();

        // Bind Relationships
        !empty($withRelationships) ? $query->with($withRelationships) : false;

        return $query->findOrFail($id);
    }

    public function store(array $payloads)
    {
        return SupportCategory::query()->create($payloads);
    }

    public function update(object $supportCategory, array $payloads)
    {
        $supportCategory->update($payloads);

        return $supportCategory;
    }

}

