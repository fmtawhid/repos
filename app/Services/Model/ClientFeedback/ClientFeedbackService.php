<?php

namespace App\Services\Model\ClientFeedback;

use App\Models\ClientFeedback;

class ClientFeedbackService
{

    public function getAll($isPaginateGetOrPluck = null, $onlyActives = null, $withRelationships = ["updatedBy", "createdBy"]) {
        $request = Request();
        $query = ClientFeedback::query()->filters();
      
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

    public function findTemplateCategoryById($id, $withRelationships = []) {
        $query = ClientFeedback::query();

        // Bind Relationships
        !empty($withRelationships) ? $query->with($withRelationships) : false;

        return $query->findOrFail($id);
    }

    public function store(array $payloads) {
        return ClientFeedback::query()->create($payloads);
    }

    public function update(object $clientFeedback, array $payloads) {
        $clientFeedback->update($payloads);
        return $clientFeedback;
    }
}
