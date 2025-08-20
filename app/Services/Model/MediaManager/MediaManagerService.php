<?php
namespace App\Services\Model\MediaManager;

use App\Models\MediaManager;
use Illuminate\Database\Eloquent\Model;
use App\Services\Model\MediaManagerCategory\MediaManagerCategoryService;
/**
 * Class MediaManagerService.
 */
class MediaManagerService
{
    public function getData()
    {
        $data = [];
        return $data;
    }
    public function all() {
        $request  = request();
        $search   = $request->search;
        $userType = $request->user_type ? intval($request->user_type) : 0;

        $query = MediaManager::query();

        if(!empty($search)) {
            $query = $query->search($search);
        }
        if(!empty($userType)) {
            $query = $query->userType($userType);
        }
        if($request->has('is_active')) {
            $query = $query->isActive(intval($request->is_active));
        }

        return $query->latest()->paginate(request('perPage', appStatic()::PER_PAGE_DEFAULT), "*", "page", request('page', 0))->withQueryString();
    }

    /**
     * MediaManager Store
     * */
    public function store($payloads) : Model
    {
        return MediaManager::query()->create($payloads);
    }

    public function findById($id)
    {
        return MediaManager::query()->find($id);
    }

}
