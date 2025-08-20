<?php
namespace App\Services\Model\Prompt;


use App\Models\PromptGroup;

class PromptGroupService {
    
    public function getAll(
        $isPaginateGetOrPluck = null,
        $onlyActives = null,
    )
    {
        $request = request();
        $query = PromptGroup::query();

        if($request->has('is_active')) {
            $query->isActive(intval($request->is_active));
        }
        if(!is_null($onlyActives)){
            $query->isActive($onlyActives);
        }
        
        if (is_null($isPaginateGetOrPluck)) {
            return $query->pluck("group_name", "id");
        }

        return $isPaginateGetOrPluck ? $query->paginate() : $query->get();
    }

    public function findPromptGroupById($id, $withRelationships = [])
    {
        $query = PromptGroup::query();

        // Bind Relationships
        !empty($withRelationships) ? $query->with($withRelationships) : false;

        return $query->findOrFail($id);
    }

    public function store(array $payloads)
    {
        return PromptGroup::query()->create($payloads);
    }

    public function update(object $chatCategory, array $payloads)
    {
            $chatCategory->update($payloads);
    
            return $chatCategory;
        }
    
}