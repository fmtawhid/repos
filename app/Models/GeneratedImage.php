<?php

namespace App\Models;

use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use App\Traits\BootTrait\CreatedUpdatedByRelationshipTrait;
use App\Traits\Models\User\UserTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stripe\ApiOperations\Create;

class GeneratedImage extends Model
{
    use HasFactory;
    use SoftDeletes;
    use CreatedUpdatedByRelationshipTrait;
    use CreatedByUpdatedByIdTrait;
    use UserTrait;


    protected $table = "generated_images";
    protected $fillable = [
        "title",
        "slug",
        "model_name",
        "prompt",
        "generated_image_path",
        "generated_image_resolution",
        "prompts_words",
        "completion_words",
        "total_words",
        "prompts_token",
        "completion_token",
        "total_token",
        "storage_type",
        "folder_id",
        "file_path",
        "article_content_type",
        "content_type",
        "platform",
        "article_id",
        "subscription_user_id",
        "subscription_plan_id",
        "template_id",
        "user_id",
        "created_by_id",
        "updated_by_id",
        "deleted_at",
        "is_active"
    ];

    public function folder()
    {
        return $this->belongsTo(Folder::class, 'folder_id', 'id')->withDefault([
            'folder_name' => localize('not found')
        ]);
    }
    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id', 'id')->withDefault([
            'template_name' => localize('not found')
        ]);
    }
    public function scopeFilters($query)
    {
        $request = request();
        return $query->when($request->search, function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%');
        })->when($request->folder_id, function ($q) use ($request) {
            $q->where('folder_id', $request->folder_id);
        })->when($request->template_id, function ($q) use ($request) {
            $q->where('template_id', $request->template_id);
        })->when($request->model_name, function ($q) use ($request) {
            $q->where('model_name', $request->model_name);
        })->when($request->subscription_plan_id, function ($q) use ($request) {
            $q->where('subscription_plan_id', $request->subscription_plan_id);
        })->when($request->article_id, function ($q) use ($request) {
            $q->where('article_id', $request->article_id);
        })->when($request->content_type, function ($q) use ($request) {
            $q->where('content_type', $request->content_type);
        })->when($request->platform, function ($q) use ($request) {
            $q->where('platform', $request->platform);
        })->where('created_by_id', userId());

        return $query;
    }
    public function scopeSearchByUser($query)
    {
        return $query->where('created_by_id', userID());
    }
}
