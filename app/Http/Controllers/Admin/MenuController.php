<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Menu\MenuStoreRequest;
use App\Http\Requests\Admin\Menu\MenuUpdateRequest;
use App\Models\Menu;
use App\Services\Menu\MenuService;
use Illuminate\Http\Request;
use App\Traits\Api\ApiResponseTrait;
use App\Utils\AppStatic;
use Illuminate\Support\Facades\DB;
use Modules\BranchModule\App\Services\BranchService;

class MenuController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $service;
    protected $branchesService;

    public function __construct()
    {
        $this->appStatic       = new AppStatic();
        $this->service         = new MenuService();
        $this->branchesService = new BranchService();
    }

    public function index(Request $request)
    {


        if ($request->ajax()) {
            $data["menus"]      = $this->service->getAll(true, null, null, true, []);

            return view('backend.admin.menus.list', $data)->render();
        }

        $data["branches"]   = $this->branchesService->getAll(null, true);


        return view("backend.admin.menus.index")->with($data);
    }


    public function store(MenuStoreRequest $request) {
        // try {
            DB::beginTransaction();

            $data = $request->getValidatedData();

            // dd($data);
            // Menu Data Storing
            $menu = $this->service->store($data);

            $menuBranches = $this->service->storeMenuBranches($menu, $request->branch_ids);

            DB::commit();

        //     return $this->sendResponse(
        //         $this->appStatic::SUCCESS_WITH_DATA,
        //         localize("Menu Created Successfully"),
        //         $menu
        //     );
        // }
        // catch (\Throwable $e) {

        //     DB::rollBack();

        //     wLog("Failed to store Menu", errorArray($e));

        //     return $this->sendResponse(
        //         $this->appStatic::VALIDATION_ERROR,
        //         localize("Failed to create Menu"),
        //         [],
        //         errorArray($e)
        //     );
        // }
    }

    public function edit(Request $request, $id)
    {
        return $this->sendResponse(
            appStatic()::SUCCESS_WITH_DATA,
            localize("Edit Menu"),
            $this->service->findbyid($id, ['branches'])
        );
    }


    public function update(MenuUpdateRequest $request, Menu $menu)
    {
        try {

            $data = $request->getValidatedData();
            $menu->update($data);

            $menu->branches()->sync($data["branch_ids"]);

            DB::commit();

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Menu Updated Successfully"),
                $menu
            );
        } catch (\Throwable $e) {

            wLog("Failed to store Menu", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to Update Menu"),
                [],
                errorArray($e)
            );
        }
    }

    public function destroy(Request $request, Menu $menu)
    {
        if ($request->ajax()) {
            try {
                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Menu successfully deleted"),
                    $menu->branches()->detach(),
                    $menu->delete()
                );
            }
            catch (\Throwable $e) {
                wLog("Failed to Delete Menu", errorArray($e));

                return $this->sendResponse(
                    $this->appStatic::VALIDATION_ERROR,
                    localize("Failed to Delete : ") . $e->getMessage(),
                    [],
                    errorArray($e)
                );
            }
        }
    }
}
