<?php

namespace App\Services\Model\Language;

use App\Models\Language;

class LanguageService 
{

    public function getAll(
        $isPaginateGetOrPluck = null,
        $onlyActives = null,
        $withRelationships = ["updatedBy", "createdBy"])
    {

        $query = Language::query()->filters()->orderBy('id', 'DESC');

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
    public function store(array $payloads)
    {
        return Language::query()->create($payloads);
    }

    public function edit(int $id)
    {
        return $this->findById($id);
    }

    public function update(object $language, array $payloads)
    {
        $language->update($payloads);

        return $language;
    }
    public function findById($id, $withRelationships = [], $conditions = [])
    {
        $query = Language::query();
        
        // condition search
        if(!empty($conditions)) {
            $query->where($conditions);
        }
        // Bind Relationships
        !empty($withRelationships) ? $query->with($withRelationships) : false;

        return $query->findOrFail($id);
    }
    
}