<?php

namespace Modules\BranchModule\App\Services;

use App\Models\User;
use Modules\BranchModule\App\Models\Branch;

class BranchService
{

    public function getAll($isPaginateGetOrPluck = null,$onlyActives = null)
    {
        $request = request();
        $query = Branch::query()->filters();

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
        return Branch::query()->create($payloads);
    }

    public function findById($id, $conditions = [])
    {
        return Branch::query()->findOrFail($id);
    }

    public function getUsersByBranchId($branchId)
    {
        return User::query()->where('branch_id', $branchId)->where('user_type', appStatic()::TYPE_VENDOR_TEAM)->get();
    }

    public function getBranchesByVendorId($vendorId)
    {
        return Branch::query()
            ->where("branches.is_active", appStatic()::ACTIVE)
            ->whereNull("branches.deleted_at")
            ->where("branches.vendor_id", $vendorId)->get();
    }

    public function getBranchesByUserBranchId($branchId)
    {
        return Branch::where('id', $branchId)->get();
    }
}
