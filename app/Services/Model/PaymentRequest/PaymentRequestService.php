<?php

namespace App\Services\Model\PaymentRequest;

use App\Models\SubscriptionUser;
use App\Traits\SubscribePlanTrait;
use App\Traits\File\FileUploadTrait;

class PaymentRequestService {
    use SubscribePlanTrait;
    use FileUploadTrait;

    public function index()
    {

    }
    public function approve(array $payloads)
    {
        $id    = $payloads['subscription_user_id'];
        $model = $this->findSubscriptionUser($id);

        $this->paymentStatus($id, appStatic()::PAYMENT_STATUS_PAID);

        return $model;
    }
    public function reject(array $payloads)
    {
        $id = $payloads['subscription_user_id'];
        $model = $this->findSubscriptionUser($id);
        if($model){
          
            $this->paymentStatus($id, appStatic()::PAYMENT_STATUS_REJECTED);
        }
        return $model;
    }
    public function feedback(array $payloads)
    {
        $id    = $payloads['subscription_user_id'];
        $model = $this->findSubscriptionUser($id);
        if($model){
            $data['feedback_note'] = $payloads['feedback_note'];
            $this->paymentStatus($id, appStatic()::PAYMENT_STATUS_RESUBMIT, $data);
        }
        return $model;
    }
    public function reSubmit(object $payloads)
    {
        $model = $this->findSubscriptionUser($payloads->subscription_user_id);
        if($model){
            $file                = $payloads->file 
            ? $this->fileProcess($payloads->file, fileService()::DIR_MEDIA, false, $height = 800, $width  = 800,$fileOriginalName = true) : null;
            $model->payment_gateway_id   = $payloads->payment_method;
            $model->offline_payment_id   = $payloads->offline_payment_method;
            $model->payment_details      = $payloads->payment_details;
            $model->note                 = $payloads->note;
            $model->file                 = $file;
            $model->subscription_status  = appStatic()::PLAN_STATUS_PENDING;
            $model->save();
        }
        return  $model;
    }
    public function findSubscriptionUser($id): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
    {
      return  SubscriptionUser::query()->findOrFail($id);
    }
}