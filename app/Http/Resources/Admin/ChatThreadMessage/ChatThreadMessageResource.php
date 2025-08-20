<?php

namespace App\Http\Resources\Admin\ChatThreadMessage;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatThreadMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"               => $this->id,
            "is_active"        => $this->is_active,
            "random_number"    => $this->random_number,
            "title"            => $this->title,
            "platform"         => $this->platform,
            "type"             => $this->type,
            "prompt"           => $this->prompt,
            "file_path"        => $this->file_path,
            "file_content"     => $this->file_content,
            "response"         => $this->response,
            "prompts_words"    => $this->prompts_words,
            "completion_words" => $this->completion_words,
            "total_words"      => $this->total_words,
            "prompts_token"    => $this->prompts_token,
            "completion_token" => $this->completion_token,
            "total_token"      => $this->total_token,
            "chat_thread_id"   => $this->chat_thread_id
        ];
    }
}
