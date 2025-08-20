<?php

namespace App\Services\Business;

use App\Models\License;
use App\Services\Action\LicenseActionService;

/**
 * Class LicenseService.
 */
class LicenseService
{

    public function getMyLicense()
    {
        return License::query()->first();
    }

    public function isPurchased(): bool
    {
        $isPurchased = false;
        $license     = (new LicenseActionService())->getMyLicense();

        if (!empty($license)) {
            $isPurchased = !empty($license->purchase_code) && !empty($license->client_token);
        }

        return $isPurchased;
    }

    public function updateLicense(
        object | null $license,
        $purchaseCode,
        $clientToken,
        $appEnv
    ): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder|null
    {
        if(is_object($license)){
            $license->update([
                'purchase_code' => $purchaseCode,
                'client_token'  => $clientToken,
                'app_env'=> $appEnv
            ]);
        }

        License::query()->create([
            'purchase_code' => $purchaseCode,
            'client_token'  => $clientToken,
            'app_env'       => $appEnv,
            "is_active"     => 1
        ]);

        return $this->getMyLicense();
    }
}
