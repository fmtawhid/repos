<?php

namespace app\Services\Action;

use Modules\PosManager\Services\PosManagerService;

class PosManagerActionService
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


    public function getCategoriesByProductProductOwnerId($productOwnerId)
    {
        return $this->posManagerService->getCategoriesByProductProductOwnerId($productOwnerId);
    }

    public function getBrandsByProductProductOwnerId($productOwnerId)
    {

        return $this->posManagerService->getBrandsByProductProductOwnerId($productOwnerId);
    }

}
