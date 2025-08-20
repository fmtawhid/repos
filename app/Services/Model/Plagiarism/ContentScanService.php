<?php

namespace App\Services\Plagiarism;

use App\Services\Core\GowinstonCore;
class ContentScanService {

    public function index()
    {

    }
    public function store($request)
    {
        $service = self::plagiarismInstance();
        $result  = $service->textDetector($this->formattedParams($request));
        $result  = json_decode($result);
    }
    public function formattedParams($request): array
    {
        $params = [
            'text' => $request->text,
            'language' => 'en',
            'sentences' => true,
            'version' => "3.0",
        ];

        return $params;  
    }
    public  static function plagiarismInstance()
    {        
        return  new GowinstonCore(plagiarismApi()); 
    }
}