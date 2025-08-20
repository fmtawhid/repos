<?php

namespace App\Services\Model\GeneratedContent;

use App\Models\GeneratedContent;
use App\Models\GeneratedImage;
  class GeneratedContentService
{
    public function getAll($isPaginateData = true) {
        $query = GeneratedContent::query()->filters()->latest();

        return $isPaginateData ? $query->paginate(maxPaginateNo(2)) : $query->get();
    }
    public function findById($id, $conditions=[], $withRelationships = [])
    {
        $query = GeneratedContent::query()->searchByUser();

        // Bind Relationships
        !empty($withRelationships) ? $query->with($withRelationships) : false;

        return $query->findOrFail($id);
    }

    public function store(array $payloads)
    {
        return GeneratedContent::query()->create($payloads);
    }

    public function update($request)
    {
        $id = $request->id;
        $model = $this->findById($id);
        if($model) {
            $model->response = $request->content;
            $model->title = $request->name;
            $model->save();
        }
        return $model;
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
