<?php

namespace App\Traits\BootTrait;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\Models\Status\IsActiveTrait;

trait FilterTrait
{
    use IsActiveTrait;
    public function scopeFilters($query)
    {
        $request = request();
        $table = $query->from;
        
        //Search
        if($request->has("search") && !empty($request->search)){
            $query->search($request->search);
        }

        // Active
        if($request->has("is_active")){
            $query->isActive((int)$request->is_active);
        }

        // Chat Expert ID
       
        if($request->has("chat_expert_id") && !empty($request->chat_expert_id)){
             // [When we use it globally have to check if column exist into table]
            if (Schema::hasColumn($table, 'chat_expert_id')) { 
                $query->where("chat_expert_id",(int)$request->chat_expert_id);
            }
        }
        if($request->has("type") && !empty($request->type)){
             // [When we use it globally have to check if column exist into table]
            if (Schema::hasColumn($table, 'type')) {
                $query->where("type",(int)$request->content_purpose);
            }

            info("41: SQL : ".$query->toRawSql());
        }

        // Chat Thread ID
        if($request->has("chat_thread_id") && !empty($request->chat_thread_id)){
            $query->where("chat_thread_id",(int)$request->chat_thread_id);
        }

        // User ID
        if($request->has("user_id") && !empty($request->user_id)){
            $query->where("user_id",(int)$request->user_id);
        }

    }
}