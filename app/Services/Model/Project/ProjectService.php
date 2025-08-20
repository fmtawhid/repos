<?php

namespace App\Services\Model\Project;

use App\Services\Model\GeneratedImage\GeneratedImageService;
use App\Services\Model\GeneratedContent\GeneratedContentService;

class ProjectService
{
    public function index()
    {

        $request = request();
      
        $type = $request->type ? $request->type : appStatic()::CONTENT_TYPE_CONTENT;

        if($type == appStatic()::CONTENT_TYPE_IMAGE) {
            $data['details'] = (new GeneratedImageService())->getAll();
        } else {
            $data['details'] = (new GeneratedContentService())->getAll();
        }
        $data['type']      = $type;
        $data['folder_id'] = intval($request->folder_id);
        return $data;
    } 
}
