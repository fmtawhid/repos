<?php

namespace App\Services\Model\OfflinePaymentMethod;

use App\Models\OfflinePaymentMethod;

class OfflinePaymentMethodService
{

    public function getAll($isPaginateGetOrPluck = null, $onlyActives = null, $withRelationships = ["updatedBy", "createdBy"]) {
        $request = Request();
        $query = OfflinePaymentMethod::query()->filters();
      
        // Bind Relationships
        (!empty($withRelationships) ? $query->with($withRelationships) : false);

        if($request->has('is_active')) {
            $query->isActive(intval($request->is_active));
        }
        if(!is_null($onlyActives)){
            $query->isActive($onlyActives);
        }

        if (is_null($isPaginateGetOrPluck)) {
            return $query->pluck("name", "id");
        }

        return $isPaginateGetOrPluck ? $query->paginate(maxPaginateNo()) : $query->get();
    }

    public function findOfflinePaymentMethodById($id, $withRelationships = [])
     {
        $query = OfflinePaymentMethod::query();

        // Bind Relationships
        !empty($withRelationships) ? $query->with($withRelationships) : false;

        return $query->findOrFail($id);
    }

    public function store(array $payloads) {
        return OfflinePaymentMethod::query()->create($payloads);
    }

    public function update(object $templateCategory, array $payloads) {
        $templateCategory->update($payloads);

        return $templateCategory;
    }
}
