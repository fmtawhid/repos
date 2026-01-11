<?php

namespace App\Services\Admin\Status;

use App\Traits\Global\AllModelNameTrait;
use App\Traits\UnHashed\UnHashedTrait;

/**
 * Class ActiveStatusService.
 */
class ActiveStatusService
{
    /**
     * Update Active Status
     *
     * @incomingParam $payloads contains Validated Array Record with id & updateFor as Model Name
     * */
    public function updateActiveStatus($model)
    {
        // If model uses account_status (users/merchants) toggle between 1 (active) and 2 (inactive)
        if (isset($model->account_status)) {
            $data['account_status'] = ($model->account_status == 1) ? 2 : 1;
        } else {
            // Fallback for models that use boolean is_active
            $data['is_active'] = !$model->is_active;
        }

        $model->update($data);

        return $model;
    }

    public function updateStatus($model, $id)
    {
        $model->where("id", $id)->update([
            "is_active" => !$model->is_active
        ]);

        return $model;
    }
}
