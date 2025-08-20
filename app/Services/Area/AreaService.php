<?php

namespace App\Services\Area;

use App\Models\Area;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AreaService.
 */
class AreaService
{

    public function getAll(
        $isPaginateGetOrPluck = null,
        $onlyActives = null,
    )
    {
        $request = request();
        $query = Area::query()->filters();

        if($request->has('is_active')) {
            $query->isActive(intval($request->is_active));
        }

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
        return Area::query()->create($payloads);
    }

    public function findById($id, $realations = [])
    {
        return Area::query()
            ->with($realations)
            ->findOrFail($id);
    }


    public function getAreaWiseTablesAndQrCode(){
        return Area::query()
            ->with('tables')
            ->get();
    }

    public function getAreaByBranchId($branch_id){
        return Area::query()
            ->whereHas('branches', function ($query) use ($branch_id) {
                $query->where('branch_id', $branch_id);
            })
            ->get();
    }


}
