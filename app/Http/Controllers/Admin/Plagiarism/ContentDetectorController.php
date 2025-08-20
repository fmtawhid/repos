<?php

namespace App\Http\Controllers\Admin\Plagiarism;

use App\Services\Balance\BalanceService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Services\Integration\IntegrationService;
use App\Http\Requests\Admin\AiDetectContentRequestForm;
use Illuminate\Support\Facades\DB;

class ContentDetectorController extends Controller
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
        return view('backend.admin.plagiarism.detect-content.form');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.plagiarism.detect-content.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AiDetectContentRequestForm $request)
    {
      
        try {
            DB::beginTransaction();

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

            // Balance Update
            (new BalanceService())->balanceUpdate($result);

            DB::commit();

            $score          = isset($result->response['score']) ? number_format($result->response['score']) : 0;
            $data['ai']     = 100 - $score;
            $data['human']  = $score;
            $view = view('backend.admin.plagiarism.detect-content.donat-chat', $data)->render();


            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Content Scan Successfully"), [],[], ['view'=>$view]
            );
        } catch (\Throwable $e) {
            DB::rollBack();

            wLog("Failed to scan content", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to scan content")." ".$e->getMessage(),
                [],
                errorArray($e)
            );
        }
    }
}
