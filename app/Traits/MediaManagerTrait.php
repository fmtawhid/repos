<?php

namespace App\Traits;

use App\Models\MediaManager;

trait MediaManagerTrait
{
    public function mediaManager()
    {
        return $this->belongsTo(MediaManager::class);
    }
}
