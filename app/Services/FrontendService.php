<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\SubscriptionPlan;
use App\Models\User;
use App\Models\Template;
use App\Services\Model\FAQ\FAQService;
use App\Services\Model\ClientFeedback\ClientFeedbackService;
use App\Services\Model\SubscriptionPlan\SubscriptionPlanService;
use App\Services\Model\TemplateCategory\TemplateCategoryService;

class FrontendService {

    public function index():array
    {
        $data = [];
        $data['faqs']                = (new FAQService())->getAll(true, true);
        $data['plans']               = (new SubscriptionPlanService())->plans('monthly', true);
        $data['client_feedbacks']    = (new ClientFeedbackService())->getAll(true);
        $data['template_categories'] = (new TemplateCategoryService())->getAll(true);
        $blog                        = Blog::with('category', 'tags')->where('is_active', 1);
        $data['blog_1']              = Blog::with('category', 'tags')->where('is_active', 1)->latest()->first();
        $data['blog_2']              = $data['blog_1'] ? $blog->whereNotIn('id', [$data['blog_1']->id])->latest()->first() : null;
        $data['blog_3']              = $data['blog_2'] ? $blog->whereNotIn('id', [$data['blog_1']->id, $data['blog_2']->id])->latest()->first() : null;
        $data['blog_4']              = $data['blog_3'] ? $blog->whereNotIn('id', [$data['blog_1']->id, $data['blog_2']->id, $data['blog_3']->id])->latest()->first() : null;
        $data['customers']           = User::query()->where('user_type', appStatic()::TYPE_CUSTOMER)->where('is_active', 1)->limit(4);
        $data['brands']              = getSetting('brand_is_active') == 1 ? explode(',', getSetting('brand_background_images')) : null;
        $data['feature_document_2_images'] = getSetting('feature_document_2_image') == 1 ? explode(',', getSetting('feature_document_2_image')) : null;

        return $data;
    }
    public function templates($request)
    {
        return Template::query()->when($request && $request->template_category_id, function($q) use($request){
            $q->where('template_category_id', $request->template_category_id);
        })->where('is_active', 1)->where('user_id', 1)->paginate(maxPaginateNo());
    }
    public function plans($request): \Illuminate\Database\Eloquent\Collection|array
    {
        return SubscriptionPlan::query()->when($request->has("type"), function($q) use($request){
            $q->where('package_type', $request->type);
        })
        ->where('is_active', appStatic()::ACTIVE)
        ->get();
    }
    public function blog($slug)
    {
        return Blog::where('slug', $slug)->first();
    }
    public function blogs()
    {
        return Blog::with('tags', 'category')->where('is_active', 1)->get();
    }
    public function latestLimit()
    {
        return Blog::with('tags', 'category')->where('is_active', 1)->latest()->limit(3)->get();
    }
}
