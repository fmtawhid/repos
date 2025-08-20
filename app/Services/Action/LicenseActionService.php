<?php

namespace App\Services\Action;

use App\Models\License;
use App\Services\Business\LicenseService;

/**
 * Class LicenseActionService.
 */
class LicenseActionService
{
    private $licenseService;
    public function __construct()
    {
        $this->licenseService = new LicenseService();
    }

    public function getMyLicense()
    {
        return $this->licenseService->getMyLicense();
    }

    public function isPurchased(): bool
    {
        return $this->licenseService->isPurchased();
    }

    public function updateLicense(object | null $license,$purchaseCode, $clientToken, $appEnv)
    {
        return $this->licenseService->updateLicense($license,$purchaseCode, $clientToken, $appEnv);
    }

}
