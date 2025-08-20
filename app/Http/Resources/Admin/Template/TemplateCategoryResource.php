<?php

namespace App\Http\Resources\Admin\Template;

use App\Http\Resources\Admin\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TemplateCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"            => $this->id,
            "category_name" => $this->category_name,
            "slug"          => $this->slug,
            "icon"          => $this->icon,
            "user_id"       => UserResource::make($this->user),
            "createdBy"     => UserResource::make($this->createdBy),
            "updatedBy"     => UserResource::make($this->updatedBy) ,
            "is_active"     => $this->is_active,
            "created_at"    => $this->created_at,
            "updated_at"    => $this->updated_at,
            "deleted_at"    => $this->deleted_at,
        ];
    }
}
