<?php

namespace App\Services\Model\FAQ;

use App\Models\FAQ;

class FAQService
{

    public function getAll(
        $isPaginateGetOrPluck = null,
        $onlyActives = null,
        $withRelationships = ["updatedBy", "createdBy"])
    {

        $query = FAQ::query()->filters()->orderBy('id', 'DESC');

        // Bind Relationships
        (!empty($withRelationships) ? $query->with($withRelationships) : false);

        if(!is_null($onlyActives)){
            $query->isActive($onlyActives);
        }

        if (is_null($isPaginateGetOrPluck)) {
            return $query->pluck("question", "id");
        }

        return $isPaginateGetOrPluck ? $query->paginate(maxPaginateNo()) : $query->get();
    }
    public function findFAQById($id, $withRelationships = [], $conditions = [])
    {
        $query = FAQ::query();

        // Bind Relationships
        !empty($withRelationships) ? $query->with($withRelationships) : false;

        return $query->findOrFail($id);
    }

    public function store(array $payloads)
    {
        return FAQ::query()->create($payloads);
    }

    public function update(object $faq, array $payloads)
    {
        $faq->update($payloads);

        return $faq;
    }

}

