<?php

namespace App\Traits\UnHashed;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Traits\Global\AllModelNameTrait;
trait UnHashedTrait
{
    use AllModelNameTrait;
    /**
     * Is Model name exits
     * */
    public function isModelNameExits($modelName,$hashedModelName)
    {
        return Hash::check($modelName, $hashedModelName);
    }

    private function getModelName($hashedModelName)
    {
        return $this->modelNames()[$hashedModelName];
    }


    /**
     * Un-Hashed ID
     * */
    public function decryptId(string $id)
    {
        return Crypt::decrypt($id);
    }
}
