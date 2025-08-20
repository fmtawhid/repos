<?php

namespace App\Http\Controllers\Admin\Template;

use App\Models\Template;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Services\Integration\IntegrationService;
use App\Services\Model\Template\TemplateService;
use App\Http\Requests\Template\TemplateRequestForm;
use App\Http\Resources\Admin\Template\TemplateResource;
use App\Http\Requests\Admin\Template\TemplateContentRequest;

class TemplateController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $templateService;

    public function __construct(
    ) {
        $this->appStatic = appStatic();
        $this->templateService = new TemplateService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $this->templateService->getData();

        if ($request->route()->getPrefix() === 'api') {
            return response()->json($data);
        }

        if ($request->ajax()) {
            return view('backend.admin.template.list', $data)->render();
        }

        return view('backend.admin.template.index', $data)->render();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TemplateRequestForm $request)
    {
        try {
            $template = $this->templateService->store($request->getData());
            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Successfully stored Template"),
                TemplateResource::make($template)
            );
        } catch (\Throwable $e) {
            wLog("Failed to Store Template", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to store Template"),
                [],
                errorArray($e)
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            $data["template"] =  $this->templateService->findByIdTemplate($id);
            if(!$data['template']) return abort(401);

            return view("backend.admin.template.generate.index")->with($data);
        }
        catch(\Throwable $e){
            wLog("Failed to Generate Template Contents", errorArray($e));

            flashMessage($e->getMessage(), 'error');

            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {     
        $template = $this->templateService->findByIdTemplate($id);
        if(!$template) return abort(401);
        $view = view('backend.admin.template.render-fields', ['fields'=>json_decode($template->fields)])->render();
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully retrieved Template"),
            $template, [], ['view'=>$view]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TemplateRequestForm $request, Template $template)
    {
        $data = $this->templateService->update($template, $request->getData());
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully Template Updated"),
            TemplateResource::make($data)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Template $template)
    {
        try {
            if ($request->ajax()) {
                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Successfully deleted Template"),
                    $template->delete()
                );
            }
        } catch (\Throwable $e) {
            wLog("Failed to Delete Template", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to Delete : ") . $e->getMessage(),
                [],
                errorArray($e)
            );
        }
    }

    public function generateTemplateContent(TemplateContentRequest $request, string $slug, TemplateService $templateService)
    {

        try{
            $data["template"] =  $templateService->findTemplateByColumnsAndValue(["slug","=",$slug]);

            return view("backend.admin.template.generate.index")->with($data);
        }
        catch(\Throwable $e){
            wLog("Failed to Generate Template Contents", errorArray($e));

            return redirect()->back();
        }
    }

    public function saveTemplateContent(TemplateContentRequest $request, $id)
    {
        try {
            // Checking Remaining Word balance.
            checkWordBalance();

            // Is Template Allowed
            checkValidCustomerFeature(allowTemplates());


            $template = $this->templateService->findTemplateByColumnsAndValue(["id","=",$id]);

            $generatedContent = $this->templateService->saveTemplateContent($template, $request->getData());

            // saving generated_content_id into session
            session()->put([
                sessionLab()::SESSION_TEMPLATE_GENERATED_CONTENT_ID => $generatedContent->id
            ]);

            return $this->sendResponse(
              $this->appStatic::SUCCESS_WITH_DATA,
              localize("Template content"),
                $generatedContent,
                [],
                [
                    "params" => $request->all()
                ]
            );
        } catch (\Throwable $e) {
            wLog("Failed to Generate Template Content", errorArray($e), logService()::LOG_OPEN_AI);

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                $e->getMessage(),
                [],
                errorArray($e)
            );
        }
    }


    public function streamTemplate(Request $request)
    {
        try{
            // Check Balance
            checkWordBalance();

            // Is Template Allowed
            checkValidCustomerFeature(allowTemplates());

            $integrationService = new IntegrationService();
            $request->merge([
                'stream'=>true
            ]);

            return $integrationService->contentGenerator(aiEngine(), $request);
        } catch(\Throwable $e) {
            wLog("Failed to Generate Text", errorArray($e), logService()::LOG_OPEN_AI);

            return $this->streamErrorResponse($e->getMessage());
        }
    }
    
    
}
