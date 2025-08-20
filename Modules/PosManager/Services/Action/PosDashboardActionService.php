<?php

namespace Modules\PosManager\Services\Action;

use Modules\PosManager\Services\Business\PosManagerService;
class PosDashboardActionService
{
    private $posManagerService;

    public function __construct()
    {
        $this->posManagerService = new PosManagerService();
    }

    public function getProductsByProductOwnerId($productOwnerId)
    {

        return $this->posManagerService->getProductsByProductOwnerId($productOwnerId);
    }

    public function getProductsByBranchIdAndVendorId($vendorId,$branchId)
    {
        return $this->posManagerService->getProductsByBranchIdAndVendorId($vendorId, $branchId);
    }

    public function getTablesByBranchId($branchId)
    {
        return $this->posManagerService->getTablesByBranchId($branchId);
    }

    public function getAreasByBranchId($branchId, $hasTables = false)
    {
        return $this->posManagerService->getAreasByBranchId($branchId, $hasTables);
    }



    public function getCategoriesByProductProductOwnerId($productOwnerId)
    {
        return $this->posManagerService->getCategoriesByProductProductOwnerId($productOwnerId);
    }

    public function getBrandsByProductProductOwnerId($productOwnerId)
    {

        return $this->posManagerService->getBrandsByProductProductOwnerId($productOwnerId);
    }

    public function registerNewCustomer(array $data)
    {
        $customerAccount = $this->posManagerService->registerNewCustomer($data);

        //reload user.php
        $customerAccount = $customerAccount->fresh();

        return [
            "customer" => $customerAccount
        ];
    }
}
