<?php

namespace App\Http\Resources\Admin\ChatCategory;

use App\Http\Resources\Admin\User\CreatedUpdatedByResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "category_name" => $this->category_name,
            "slug" => $this->slug,
            "is_active" => $this->is_active,
            "created_by" => CreatedUpdatedByResource::make($this->createdBy),
            "updated_by" => CreatedUpdatedByResource::make($this->updatedBy),
            "created_at" => manageDateTime($this->created_at,2),
            "updated_at" => manageDateTime($this->updated_at,2),

        ];
    }
}
