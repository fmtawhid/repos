<?php

namespace App\Http\Resources\Admin\ChatThread;

use App\Http\Resources\Admin\ChatExpert\ChatExpertResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatThreadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"           => $this->id,
            "type"         => $this->type,
            "title"        => $this->title,
            "chat_expert"  => ChatExpertResource::make($this->chatExpert),
            "created_at"   => $this->created_at->diffForHumans()
        ];
    }
}
