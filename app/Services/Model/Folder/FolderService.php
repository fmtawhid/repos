<?php

namespace App\Services\Model\Folder;

use App\Models\Folder;
use App\Traits\UnHashed\UnHashedTrait;
use App\Traits\Global\AllModelNameTrait;
use App\Services\Model\GeneratedImage\GeneratedImageService;
use App\Services\Model\GeneratedContent\GeneratedContentService;

class FolderService
{
    use AllModelNameTrait;
    use UnHashedTrait;
    public function getAll(
        $isPaginateGetOrPluck = null,
        $onlyActives = null,
        $withRelationships = ["updatedBy", "createdBy"])
    {

        $query = Folder::query()->withCount(['generateImages', 'generateContents'])->filters()->orderBy('id', 'DESC');

        // Bind Relationships
        (!empty($withRelationships) ? $query->with($withRelationships) : false);

        if(!is_null($onlyActives)){
            $query->isActive($onlyActives);
        }

        if (is_null($isPaginateGetOrPluck)) {
            return $query->pluck("folder_name", "id");
        }

        return $isPaginateGetOrPluck ? $query->paginate(maxPaginateNo()) : $query->get();
    }

    public function findFolderById($id, $withRelationships = [], $conditions = [])
    {
        $query = Folder::query();

        // Bind Relationships
        !empty($withRelationships) ? $query->with($withRelationships) : false;

        return $query->findOrFail($id);
    }

    public function store(array $payloads)
    {
        return Folder::query()->create($payloads);
    }

    public function update(object $folder, array $payloads)
    {
        $folder->update($payloads);

        return $folder;
    }

    public function details($id, $type = null )
    {
        $type = $type == null ? appStatic()::CONTENT_TYPE_CONTENT : $type;

        if($type == appStatic()::CONTENT_TYPE_IMAGE) {
            $data['details'] = (new GeneratedImageService())->getAll();
        }else {
            $data['details'] = (new GeneratedContentService())->getAll();
        }
        $data['type']      = $type;
        $data['folder_id'] = $id;
        return $data;
    }
    public function moveToFolderContent($payloads)
    {
        $data['folders'] = $this->getAll(null, 1);
        $data['model_id']= $payloads['id'];
        $data['model']   = $payloads['model'];
        return $data;
    }
    public function moveToFolder($payloads)
    {
        $convertModel = $this->getModelName($payloads['model']);
        $model = findById($convertModel, $payloads['model_id'], [], ['created_by_id', user()->id]);
      
        $model->update([
            'folder_id'=>$payloads['folder_id']
        ]);
     
        return $model;
    }
}
