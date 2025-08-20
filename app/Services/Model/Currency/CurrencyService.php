<?php

namespace App\Services\Model\Currency;

use App\Models\Currency;

class CurrencyService {

    public function getAll(
        $isPaginateGetOrPluck = null,
        $onlyActives = null,
        $withRelationships = ["updatedBy", "createdBy"])
    {

        $query = Currency::query()->filters()->orderBy('id', 'DESC');

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
        return Currency::query()->create($payloads);
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
        $query = Currency::query();
        
        // condition search
        if(!empty($conditions)) {
            $query->where($conditions);
        }
        // Bind Relationships
        !empty($withRelationships) ? $query->with($withRelationships) : false;

        return $query->findOrFail($id);
    }
    
}