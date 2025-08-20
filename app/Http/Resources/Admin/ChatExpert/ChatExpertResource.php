<?php

namespace App\Http\Resources\Admin\ChatExpert;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatExpertResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "expert_name"        => $this->expert_name,
            "short_name"         => $this->short_name,
            "slug"               => $this->slug,
            "description"        => $this->description,
            "role"               => $this->role,
            "assists_with"       => $this->assists_with,
            "chat_training_data" => $this->chat_training_data,
            "avatar"             => $this->avatar,
            "type"               => $this->type
        ];
    }
}
