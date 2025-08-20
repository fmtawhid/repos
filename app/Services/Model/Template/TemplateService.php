<?php
namespace App\Services\Model\Template;

use App\Models\User;
use App\Models\Template;
use App\Models\GeneratedContent;
use Illuminate\Database\Eloquent\Model;
use App\Services\Model\TemplateCategory\TemplateCategoryService;
/**
 * Class TemplateService.
 */
class TemplateService
{
    public function getData()
    {
        $data['templates']      = $this->all();
        $data['template_categories'] = $this->templateCategories();
        return $data;
    }

    public function all() {
        
        $request  = request();
        $search   = $request->search;
        $userType = $request->user_type ? intval($request->user_type) : 0;
        $templateCategoryId = $request->template_category_id == 'all' ?  null : $request->template_category_id;
        $templateIds = $this->userPlanTemplateIds();
        $query = Template::query()->when(isCustomer(), function($q) use($templateIds){
            $q->whereIn('id', $templateIds)->orWhere('created_by_id', user()->id);
        });

        !empty($search) ? $query = $query->search($search) : $query;
        !empty($userType) ? $query = $query->userType($userType) : $query;
        !empty($userType) ? $query = $query->userType($userType) : $query;
        !empty($templateCategoryId) ? $query = $query->templateCategory($templateCategoryId) : $query;

        $request->has('is_active') ? $query = $query->isActive(intval($request->is_active)) : $query;

        return $query->latest()->paginate(request('perPage', appStatic()::PER_PAGE_DEFAULT), "*", "page", request('page', 0))->withQueryString();
    }

    /**
     * Template Store
     * */
    public function store($payloads) : Model 
    {
        return Template::query()->create($payloads);
    }

    /**
     * Template Update
     * */
    public function update($template, $payloads) : Model 
    {
        $template->update($payloads);

        return $template;
    }
    public function templateCategories()
    {
        $templateCategory = new TemplateCategoryService();
        $with = ['templates'];
        return $templateCategory->getAll('get', true, $with);
    }

    public function findTemplateByColumnsAndValue(array $columnsAndValues, $with = [])
    {
        $query = Template::query()->where([$columnsAndValues])->firstOrFail();

        !empty($with) ? $query->with($with) : $query;

        return $query->firstOrFail();
    }
    public function findByIdTemplate($id, $conditions=[])
    {
       $templateIds = $this->userPlanTemplateIds();
       
       return  self::initModel()->where('id', $id)
       ->when(!isAdmin(), function($q) use($templateIds){
            $q->whereIn('id', $templateIds);
        })
        ->when(!empty($conditions), function($q) use($conditions){
            $q->where($conditions);
        })->first();
    }
    public function saveTemplateContent(object $template, array $payloads)
    {
        return GeneratedContent::query()->create($payloads);
    }
    private static function initModel()
    {
        return new Template();
    }
    public function userPlanTemplateIds($user_id = null)
    {
        $user_id = $user_id ?? getUserParentId();
        $user    = findById(new User(), $user_id);
       return $user->userSubscriptionTemplate->pluck('template_id')->toArray() ?? [];
    }
}
