<?php

namespace App\Services\Business;

use Illuminate\Support\Facades\Cache;

/**
 * Class WebsiteService.
 */
class WebsiteService
{


    public function getFaviconSrc()
    {
        // Check if the favicon is already cached
        if (Cache::has('favicon_src')) {
            // If it is, retrieve the cached value
            return Cache::get('favicon_src');
        }

        // If it's not, retrieve the favicon and cache the result
        $favicon    = getSetting('favicon_media_manager_id');
        $faviconSrc = "dashboardFiles/img/logo.png";

        if (!empty($favicon)) {
            $getFavicon = findById(new \App\Models\MediaManager(), $favicon);
            $faviconSrc = $getFavicon->media_file ?? null;
        }

        // Cache the favicon source for future use
        Cache::put('favicon_src', $faviconSrc, now()->addYear(1));

        return $faviconSrc;
    }
}
