<?php

namespace App\Utils;

use phpDocumentor\Reflection\Types\Self_;
use function Laravel\Prompts\select;

class AppIntegrationUrlKey
{
    #KEYS
    const API_KEY_CLIPDROP = "86f841259a8fb24dabb7154cbaad72ae620bf745b7bdc133ab86f3cfefd123366d6fea61c1bcfda5409e9f1878748203";
    const API_KEY_PEBBLELY = "20110cba-d9af-4dd0-915e-0092b6b3c3f5";
    const API_KEY_HEY_GEN  = "MDkxNjQ4ODFkZmYyNDMxMDk4OTc1MmVjNjY0MzJiZDYtMTczNDUxNDk5OA==";


    #URLS
    const BASE_URL_CLIPDROP_API = "https://clipdrop-api.co/";
    const REIMAGINE_URL          = self::BASE_URL_CLIPDROP_API . "reimagine/v1/reimagine";
    const REMOVE_BACKGROUND_URL  = self::BASE_URL_CLIPDROP_API . "remove-background/v1";
    const REPLACE_BACKGROUND_URL = self::BASE_URL_CLIPDROP_API . "replace-background/v1";
    const REMOVE_TEXT_URL        = self::BASE_URL_CLIPDROP_API . "remove-text/v1";
    const TEXT_TO_IMAGE_URL      = self::BASE_URL_CLIPDROP_API . "text-to-image/v1";
    const SKETCH_TO_IMAGE_URL    = self::BASE_URL_CLIPDROP_API . "sketch-to-image/v1/sketch-to-image";
    const UPSCALE_URL            = self::BASE_URL_CLIPDROP_API . "image-upscaling/v1/upscale";


    //PEBBELLY URLS
    const BASE_URL_PEBBLELY     = "https://api.pebblely.com/";
    const PEBBLELY_THEMES_URL   = self::BASE_URL_PEBBLELY . "themes/v1";
    const PEBBLELY_GENERATE_URL = self::BASE_URL_PEBBLELY . "generate";

    #Eleven-Labs
    const BASE_URL_ELEVEN_LABS = "https://api.elevenlabs.io/v1/";


    #HeyGen Default API
    const BASE_URL_HEY_GEN = "https://api.heygen.com/v2/";
    const BASE_URL_HEY_GEN_VIDEO = "https://api.heygen.com/v1/video.list";


    public function getBaseUrlClipdropApi()
    {
        return self::BASE_URL_CLIPDROP_API;
    }

    #HeyGen Default API
    public function getHeyGenApiURL($isVideo = false)
    {
        if($isVideo){
            return self::BASE_URL_HEY_GEN_VIDEO;
        }

        return self::BASE_URL_HEY_GEN;
    }

    public function getClipDropApiKey()
    {

        return getSetting('ai_photo_studio_api_key');
    }

    // PEBBLELY API KEY
    public function getPebblelyApiKey()
    {

        return getSetting('ai_product_shot_api_key');
    }

    // ElevenLabs API KEY
    public function getElevenLabsApiKey()
    {

        return getSetting('eleven_labs_api_key');
    }

    public function getHeyGenApiKey()
    {

        return getSetting('api_avatar_pro_api_key');
    }

    public function getStableDiffusionApiKey()
    {
        return env("SD_API_KEY"); //TODO::Will implement later
    }

    public function getAzureApiKey()
    {
        return getSetting('azure_key', env("AZURE_API_KEY"));
    }

    public function getSEOApiKey()
    {
        //TODO:: Need to add setting for the SEO Content Optimizer

        return getSetting('seo_review_tool_api_key', env("SEO_API_KEY"));
    }

    public function getUnsplashSecretKey()
    {
        return getSetting("unsplash_secret_key", env("UNSPLASH_SECRET_KEY"));
    }

    public function getUnsplashClientKey()
    {
        return getSetting("unsplash_client_key", env("UNSPLASH_CLIENT_KEY"));
    }


    /**
     * URLS
     * */
    public function getSEOBaseURL()
    {

        return "https://api.seoreviewtools.com/";
    }

    public function getUnsplashBaseURL()
    {
        return "https://api.unsplash.com/";
    }

    public function getUnsplashSearchURL()
    {
        return $this->getUnsplashBaseURL() . "search/photos";
    }
}