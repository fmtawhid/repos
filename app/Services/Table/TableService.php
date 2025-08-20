<?php

namespace App\Services\Table;

use App\Models\Table;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TableService.
 */
class TableService
{

    public function getAll(
        $isPaginateGetOrPluck = null,
        $onlyActives = null,
    )
    {
        $request = request();
        $query = Table::query();

        if($request->has('is_active')) {
            $query->isActive(intval($request->is_active));
        }
        if(!is_null($onlyActives)){
            $query->isActive($onlyActives);
        }
        
        if (is_null($isPaginateGetOrPluck)) {
            return $query->pluck("table_code", "id");
        }

        return $isPaginateGetOrPluck ? $query->paginate() : $query->get();
    }

    public function store($payloads) : Model
    {
        return Table::query()->create($payloads);
    }

    public function findById($id, $conditions = [])
    {
        return Table::query()->when(!empty($conditions), function($q) use($conditions){
            $q->where($conditions);
        })->findOrFail($id);
    }


    public function findTableByAreaId($area_id, $relations = [])
    {
        return Table::query()->where('area_id', $area_id)
            ->with($relations)
            ->get();
    }

    public function getTablesByBranchIdUsingAreaBranch($branch_id, $relations = [])
    {
        return Table::query()
            ->whereHas('area', function ($query) use ($branch_id) {
                $query->whereHas('branches', function ($q) use ($branch_id) {
                    $q->where('branch_id', $branch_id);
                });
            })
            ->with($relations)
            ->get()
            ->groupBy('area_id');




            //  return Table::query()
            // ->whereHas('area', function ($query) use ($branch_id) {
            //     $query->whereHas('branches', function ($q) use ($branch_id) {
            //         $q->where('branch_id', $branch_id);
            //     });
            // })
            // ->with($relations)
            // ->get()
            // ->groupBy('area_id');
    }


}
