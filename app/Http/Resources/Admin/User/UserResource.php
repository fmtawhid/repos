<?php

namespace App\Http\Resources\Admin\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"                            => $this->id,
            "name"                          => $this->name,
            "email"                         => $this->email,
            "email_verified_at"             => $this->email_verified_at,
            "password"                      => $this->password,
            "mobile_no"                     => $this->mobile_no,
            "verification_code"             => $this->verification_code,
            "verification_code_expired_at"  => $this->verification_code_expired_at,
            "provider_id"                   => $this->provider_id,
            "provider_type"                 => $this->provider_type,
            "avatar"                        => urlVersion($this->avatar),
            "referral_code"                 => $this->referral_code,
            "num_of_clicks"                 => $this->num_of_clicks,
            "parent"                        => $this->createdBy ?? [],
        ];
    }
}
