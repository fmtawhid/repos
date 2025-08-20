<?php

namespace App\Services\Menu;

use App\Models\Menu;
use App\Traits\Models\Status\IsActiveTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MenuService.
 */
class MenuService
{

    public function getAll(
        $isPaginateGetOrPluck = null,
        $onlyActives = null
    )
    {
        $request = request();
        $query = Menu::query()->filters();

        if($request->has('is_active')) {
            $query->isActive(intval($request->is_active));
        }else{
            if(!is_null($onlyActives)){
                $query->isActive($onlyActives);
            }
        }

        if (is_null($isPaginateGetOrPluck)) {
            return $query->pluck("name", "id");
        }

        return $isPaginateGetOrPluck ? $query->paginate(maxPaginateNo()) : $query->get();
    }

    public function store($payloads) : Model
    {
        return Menu::query()->create($payloads);
    }

    public function findById($id, $relations = [])
    {
        return Menu::query()
            ->with($relations)
            ->findOrFail($id);
    }

    public function storeMenuBranches(object $menu, $branchIds)
    {
        $menu->branches()->attach($branchIds);

        return $menu;
    }


}
