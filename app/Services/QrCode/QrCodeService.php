<?php

namespace App\Services\QrCode;

use App\Models\Area;
use Illuminate\Support\Str;

use App\Models\QrCode;

/**
 * Class QrCodeService.
 */
class QrCodeService
{
    // public function getAll(
    //     $isPaginateGetOrPluck = null,
    //     $onlyActives = null,
    //     $relationship = [], //relationship
    // )
    // {
    //     $request = request();
    //     $query = QrCode::query();

    //     if($request->has('is_active')) {
    //         $query->isActive(intval($request->is_active));
    //     }
    //     if(!is_null($onlyActives)){
    //         $query->isActive($onlyActives);
    //     }
        
    //     if (is_null($isPaginateGetOrPluck)) {
    //         return $query->pluck("code", "id");
    //     }

    //     return $isPaginateGetOrPluck ? $query->paginate() : $query->get();
    // }



    public function createQrCode($data)
    {           
        return QrCode::query()->create([
            'code' => $this->generateUniqueQrCode()
        ]);
    }



    public function generateUniqueQrCode()
    {
        $qrCode = $this->randomString();

        while (QrCode::query()->where('code', $qrCode)->exists()) {
            $qrCode = $this->randomString();
        }

        return $qrCode;
    }

    private function randomString(){
        return Str::random(12);        
        // return Str::random(6) . '-' . Str::random(4) . '-' . Str::random(4) . '-' . Str::random(4) . '-' . Str::random(12);        
    }


    public function getTableByQrCode($qrCode){
        $data = QrCode::query()
            ->where('code', $qrCode)->first();

            if($data){
                return $data->table->id;
            }
            return null;
    }



}