<?php

namespace App\Http\Resources\Admin\Folder;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FolderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "folder_name" => $this->folder_name,        
            "slug"        => $this->slug,
            'user_id'     => $this->user_id,
            'total_file'  => 0       
        ];
    }
}
