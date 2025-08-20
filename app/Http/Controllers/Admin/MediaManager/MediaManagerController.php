<?php

namespace App\Http\Controllers\Admin\MediaManager;

use App\Http\Controllers\Controller;
use App\Services\Model\MediaManager\MediaManagerService;
use App\Traits\Api\ApiResponseTrait;

class MediaManagerController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $mediaManagerService;
    public function __construct()
    {
        $this->appStatic = appStatic();
        $this->mediaManagerService = new MediaManagerService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.admin.mediaManager.index');
    }
}
