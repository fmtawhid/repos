<?php

namespace Modules\KitchenManager\App\Services;

use Modules\KitchenManager\App\Models\Kitchen;

class KitchenService
{

    public function getAll($isPaginateGetOrPluck = null,$onlyActives = null)
    {
        $request = request();
        $query = Kitchen::query()->filters();

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

    public function store($payloads)
    {
        return Kitchen::query()->create($payloads);
    }

    public function findById($id, $conditions = [])
    {
        return Kitchen::query()->findOrFail($id);
    }
}
