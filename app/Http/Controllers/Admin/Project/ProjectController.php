<?php

namespace App\Http\Controllers\Admin\Project;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Model\Project\ProjectService;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct()
    {
        $this->projectService = new ProjectService();
    }

    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $data                 = $this->projectService->index();
        if ($request->ajax()) {
           return $data['type'] == appStatic()::CONTENT_TYPE_IMAGE 
                ? view('backend.admin.projects._images', $data)->render() : view('backend.admin.projects._contents', $data)->render();
        }
        return view('backend.admin.projects.index', $data);
    }
   
}
