<?php

namespace App\Services\Model\Prompt;

use App\Models\Prompt;
use App\Services\Model\Prompt\PromptGroupService;

/**
 * Class PromptService.
 */
class PromptService
{
    public function index():array
    {
        $data = [];
        $data['groups'] = (new PromptGroupService())->getAll(false, true);
        $data['prompts'] = $this->getAll(true);
        return $data;
    }
    public function getAll(
        $isPaginateGetOrPluck = null,
        $onlyActives = null,
    ) {
        $request = request();
        $query = Prompt::query()->filters();
        if($request->has('is_active')) {
            $query->isActive(intval($request->is_active));
        }
        if(!is_null($onlyActives)){
            $query->isActive($onlyActives);
        }

        if (is_null($isPaginateGetOrPluck)) {
            return $query->pluck("name", "id");
        }

        return $isPaginateGetOrPluck ? $query->paginate() : $query->get();
    }

    public function findPromptById($id, $withRelationships = [])
    {
        $query = Prompt::query();

        // Bind Relationships
        !empty($withRelationships) ? $query->with($withRelationships) : false;

        return $query->findOrFail($id);
    }

    public function store(array $payloads)
    {
        return Prompt::query()->create($payloads);
    }

    public function update(object $chatCategory, array $payloads)
    {
        $chatCategory->update($payloads);

        return $chatCategory;
    }
    public function groupPrompts($request= null)
    {
        return Prompt::when($request->id != 'all', function($q) use($request){
            $q->where('prompt_group_id', $request->id);
        })->where('is_active', 1)->paginate(maxPaginateNo());
    }
}
