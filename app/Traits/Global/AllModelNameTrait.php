<?php

namespace App\Traits\Global;

use App\Models\Tag;
use App\Models\Blog;
use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use App\Models\Folder;
use App\Models\Ticket;
use App\Models\Category;
use App\Models\Template;
use App\Models\ChatExpert;
use App\Models\Permission;
use App\Models\BlogCategory;
use App\Models\ChatCategory;
use App\Models\GeneratedImage;
use App\Models\SupportCategory;
use App\Models\SupportPriority;
use App\Models\GeneratedContent;
use App\Models\SubscriptionPlan;
use App\Models\TemplateCategory;
use Modules\WordpressBlog\App\Models\WpCredential;
use Modules\WordpressBlog\App\Models\WpSetting;

trait AllModelNameTrait
{

    /**
     * Model Names & Model
     * */
    public function modelNames()
    {
        return [
            "user"                  => new User(),
            "permission"            => new Permission(),
            "role"                  => new Role(),
            "category"              => new Category(),
            'subscription'          => new SubscriptionPlan(),
            "chat_expert"           => new ChatExpert(),
            "chat_category"         => new ChatCategory(),
            "template_category"     => new TemplateCategory(),
            'page'                  => new Page(),
            'subscription_plan'     => new SubscriptionPlan(),
            'blog_category'         => new BlogCategory(),
            'generated_content'     => new GeneratedContent(),
            'generated_image'       => new GeneratedImage(),
            'folder'                => new Folder(),
            'template'              => new Template(),
            'tag'                   => new Tag(),
            'blog'                  => new Blog(),
            'support_category'      => new SupportCategory(),
            'ticket'                => new Ticket(),
            'priority'              => new SupportPriority(),
            'wordpress_settings'    => new WpSetting(),
            'wordpress_credentials' => new WpCredential(),
        ];
    }
}
