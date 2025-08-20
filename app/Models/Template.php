<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use App\Models\TemplateLocalization;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\Status\IsActiveTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Template extends Model
{
    use HasFactory, SoftDeletes;
    use IsActiveTrait, CreatedByUpdatedByIdTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "template_category_id",
        "template_name",
        "description",
        "slug",
        "icon",
        "fields",
        "prompt",
        "code",
        "total_words_generated",
        "total_view",
        "total_favourite",
        "is_default",
        "is_popular",
        "is_favourite",
        "is_active",
        "updated_at",

    ];
    protected $with = ['template_localizations'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    public function collectLocalization($entity = '', $lang_key = '')
    {
        $lang_key = $lang_key ==  '' ? App::getLocale() : $lang_key;
        $template_localizations = $this->template_localizations->where('lang_key', $lang_key)->first();
        return $template_localizations != null && $template_localizations->$entity ? $template_localizations->$entity : $this->$entity;
    }

    public function template_localizations()
    {
        return $this->hasMany(TemplateLocalization::class);
    }
    public function templateCategory()
    {
        return $this->belongsTo(TemplateCategory::class, 'template_category_id', 'id')->withDefault([
            'category_name'=>localize('Not found')
        ]);
    }
    public function scopeSearch($query, $search) {
        $query = $query->when($search, function($q) use ($search) {
            $q->where(function($newQ) use ($search) {
                $newQ->name($search, true, true)
                ->description($search, true, true);
            });
        });
    }
    public function scopeTemplateCategory($query, $template_category_id) {
        $query = $query->when($template_category_id, function($q) use ($template_category_id) {
            $q->where('template_category_id', $template_category_id);
        });
    }

    public function scopeName($query, $name, $isLike = true, $orWhere = false) {
        $opt = "like"; $val = '%'. $name .'%';
        if(!$isLike) {
            $opt = "="; $val = $name;
        }

        $orWhere ? $query->orWhere('template_name', $opt, $val) : $query->where('template_name', $opt, $val);
    }

    public function scopeDescription($query, $description, $isLike = true, $orWhere = false) {
        $opt = "like"; $val = '%'. $description .'%';
        if(!$isLike) {
            $opt = "="; $val = $description;
        }

        $orWhere ? $query->orWhere('description', $opt, $val) : $query->where('description', $opt, $val);
    }
    public function template_word_counts()
    {
        return $this->hasMany(GeneratedContent::class, 'template_id', 'id')->sum('total_words');
    }
}
