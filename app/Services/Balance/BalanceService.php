<?php

namespace App\Services\Balance;

use App\Models\GeneratedContent;
use App\Services\AiData\AiDataService;
use App\Services\Core\AiConfigService;
use App\Services\Model\ChatExpert\ChatExpertService;
use App\Services\Model\ChatThread\ChatThreadService;

/**
 * Class BalanceService.
 */
class BalanceService
{

    public function updateBranchBalance(object $user, $qty = 1)
    {
        $usage = $user->usage;

        // When Subscription Found
        if(!empty($usage)){
            $usage->branch_balance_used      = $usage->branch_balance_used + $qty;
            $usage->branch_balance_remaining = $usage->branch_balance_remaining - $qty;
            $usage->save();

            return $usage;
        }


        throw new \Exception("Failed! No subscription found.");
    }


}
