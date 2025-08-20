<?php

namespace App\Services\ItemCategory;

use App\Models\ItemCategory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemCategoryService.
 */
class ItemCategoryService
{

    public function getAll(
        $isPaginateGetOrPluck = null,
        $onlyActives = null,
    )
    {
        $request = request();

        $query = ItemCategory::query()->filters();

        if(!is_null($onlyActives)){
            $query->isActive($onlyActives);
        }

        if (is_null($isPaginateGetOrPluck)) {
            return $query->pluck("name", "id");
        }

        return $isPaginateGetOrPluck ? $query->paginate() : $query->get();
    }

    public function store($payloads) : Model
    {
        return ItemCategory::query()->create($payloads);
    }

    public function findById($id, $conditions = [])
    {
        return ItemCategory::query()->when(!empty($conditions), function($q) use($conditions){
            $q->where($conditions);
        })->findOrFail($id);
    }


}
