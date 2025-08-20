<?php

namespace App\Services\Model\Page;

use App\Models\Page;

class PageService
{

    public function getAll($isPaginateGetOrPluck = null, $onlyActives = null, $withRelationships = ["updatedBy", "createdBy"]) {
        $request = Request();
        $query = Page::query()->filters();
      
        // Bind Relationships
        (!empty($withRelationships) ? $query->with($withRelationships) : false);

        if($request->has('is_active')) {
            $query->isActive(intval($request->is_active));
        }
        if(!is_null($onlyActives)){
            $query->isActive($onlyActives);
        }

        if (is_null($isPaginateGetOrPluck)) {
            return $query->pluck("title", "id");
        }

        return  $isPaginateGetOrPluck ? $query->paginate(maxPaginateNo()) : $query->get();
    }

    public function findPageById($id, $withRelationships = []) {
        $query = Page::query();

        // Bind Relationships
        !empty($withRelationships) ? $query->with($withRelationships) : false;

        return $query->findOrFail($id);
    }

    public function store(array $payloads) {
        return Page::query()->create($payloads);
    }

    public function update(object $page, array $payloads) {
        $page->update($payloads);
        return $page;
    }
}
