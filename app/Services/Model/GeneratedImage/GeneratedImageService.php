<?php

namespace App\Services\Model\GeneratedImage;

use App\Models\GeneratedImage;

class GeneratedImageService
{
    public function getAll(
        $isPaginateData = true,
        $content_purpose = null
    )
    {
        $query = GeneratedImage::query()->filters()->when($content_purpose, function($q) use($content_purpose){
            $q->where('content_purpose', $content_purpose);
        })->latest();
        return $isPaginateData ? $query->paginate(maxPaginateNo(2)) : $query->get();
    }
    public function findById($id, $conditions=[], $withRelationships = [])
    {
        $query = GeneratedImage::query()->searchByUser();
        !empty($withRelationships) ? $query->with($withRelationships) : false;

        return $query->findOrFail($id);
    }
    public function delete(int $id)
    {
        $model = $this->findById($id);
        if($model){
            $model->delete();
            return true;
        }
        return false;
    }

}