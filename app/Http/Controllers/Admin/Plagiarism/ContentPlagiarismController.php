<?php

namespace App\Http\Controllers\Admin\Plagiarism;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Services\Plagiarism\ContentScanService;
use App\Services\Integration\IntegrationService;
use App\Http\Requests\Admin\AiPlagiarismContentRequestForm;

class ContentPlagiarismController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $ContentScanService;

    public function __construct()
    {
        $this->appStatic = appStatic();

    }
    public function index()
    {
        return view('backend.admin.plagiarism.plagiarism-content.form');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.plagiarism.plagiarism-content.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AiPlagiarismContentRequestForm $request)
    {
        try {
            $result = (new IntegrationService())->contentGenerator(appStatic()::ENGINE_GOWINSTON_AI, $request);
            
            if(is_array($result)) {
                if (array_key_exists('error',$result) && array_key_exists('description', $result)) {
                    return $this->sendResponse(
                        $this->appStatic::VALIDATION_ERROR,
                        $result['description'],
                        [],
                       
                    );
                }
            }
            $score          = isset($result->response['score']) ? number_format($result->response['score']) : 0;
            $data['ai']     = 100 - $score;
            $data['human']  = number_format($score);
            $data['results']= isset($result->response['results']) ? $result->response['results'] : null;
            $view = view('backend.admin.plagiarism.plagiarism-content.matching-plagiarism', $data)->render();
            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Content Scan plagiarism Successfully"), [],[], ['view'=>$view]
            );
        } catch (\Throwable $e) {

            wLog("Failed to scan plagiarism content", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to scan content")
                [],
                errorArray($e)
            );
        }
    }

}
