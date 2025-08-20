<?php

namespace App\Http\Controllers\Admin\Query;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Model\Query\QueryService;
use App\Traits\Api\ApiResponseTrait;

class QueryController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $queryService;
    public function __construct()
    {
        $this->appStatic = appStatic();
        $this->queryService = new QueryService();
    }
    public function index(Request $request)
    {
        $data['queries'] = $this->queryService->getAll(true);

        if ($request->ajax()) {
            return view('backend.admin.queries.lists', $data)->render();
        }

        return view("backend.admin.queries.index")->with($data);
    }
    public function read($id)
    {
        $this->queryService->read($id);
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            "Operation Successfully",

        );
    }

    public function deleteAll()
    {
        $this->queryService->deleteAll();
        return redirect()->back();
    }


    public function destroy(Request $request, $id)
    {
        try {
            $this->queryService->delete($id);
            if ($request->ajax()) {
                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    "Successfully deleted",
                );
            }
        } catch (\Throwable $e) {
            wLog("Failed to Delete", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                "Failed to Delete : " . $e->getMessage(),
                [],
                errorArray($e)
            );
        }
    }
}
