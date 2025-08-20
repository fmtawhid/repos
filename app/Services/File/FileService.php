<?php

namespace App\Services\File;

use App\Traits\File\FileUploadTrait;

class FileService
{
    use FileUploadTrait;
    const FILE_RENAME_PREFIX    = "_writerap_";

    const DIR_DEFUALT    = "uploads";
    const DIR_FILE       = "files";
    const DIR_MEDIA      = "uploads/media";
    const DIR_S2T        = "s2t";
    const DIR_OPEN_AI    = self::DIR_DEFUALT."/openAi";

    public const TEMP_PDF_DIR = self::DIR_DEFUALT."/pdfChats";

    const DIR_CATEGORY   = self::DIR_DEFUALT."/categories";
    const DIR_BRAND      = self::DIR_DEFUALT."/brands";
    const DIR_PRODUCTS   = self::DIR_DEFUALT."/products";
    const DIR_PRODUCT_THUMBNAIL  = self::DIR_PRODUCTS."/thumbnails";

    const DIR_ADMIN_LOGO = self::DIR_DEFUALT.'/admin';

    const DIR_BLOG_IMAGE = self::DIR_DEFUALT.'/blogs';
    const DIR_APPEARANCE = self::DIR_DEFUALT.'/appearance';
    const DIR_TICKET     = self::DIR_DEFUALT.'/ticket';
    const DIR_PAGE       = self::DIR_DEFUALT.'/page';
    const DIR_USER_IMAGE = self::DIR_DEFUALT.'/user';
    const DIR_LOCATION_BANNER = self::DIR_DEFUALT.'/locations';
    const DIR_DALL_E_2 = self::DIR_OPEN_AI.'/dall-e-2';
    const DIR_DALL_E_3 = self::DIR_OPEN_AI.'/dall-e-3';
    const DIR_SD = self::DIR_DEFUALT.'/stable-diffusion';
    const DIR_AI_VISION = self::DIR_OPEN_AI.'/ai-vision';
    const DIR_CLIPDROP = self::DIR_DEFUALT.'/clipdrop';
    const DIR_PRODUCT_SHOT   = self::DIR_DEFUALT.'/product-shot';
    const DIR_WORDPRESS   = self::DIR_DEFUALT.'/wordpress';



    /**
     * @incomingParams $contentPurpose will receive a string value
     *
     * $contentPurpose may receive "dall-e-2" or "dall-e-3" or "SD" as stable Diffusion.
     * */
    public function setStorageDirectory($contentPurpose)
    {
        $appStatic = appStatic();

        return match($contentPurpose){
            $appStatic::DALL_E_2 => self::DIR_DALL_E_2,
            $appStatic::DALL_E_3 => self::DIR_DALL_E_3,
            $appStatic::SD_TEXT_2_IMAGE => self::DIR_SD,
            default => self::DIR_DEFUALT
        };
    }


    /**
     * Temp File Processing for AI Vision
     * */
    public function tempFileProcessing($files, $contentPurpose = null) : array
    {
        $uploadedDirArray = [];
        
        foreach ($files as $key=>$file) {
            $uploadDir = self::DIR_AI_VISION;
            $uploadedDirArray[]=  $this->uploadFile($file, $uploadDir,true,false);
        }

        session([sessionLab()::SESSION_AI_VISION_IMAGES => $uploadedDirArray]);
        session()->save();

        return $uploadedDirArray;
    }

}