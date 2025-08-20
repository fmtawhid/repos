<?php

namespace App\Http\Controllers\Admin\AvatarPro;

use App\Services\Balance\BalanceService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use Illuminate\Support\Facades\Http;
use App\Services\Action\VoiceService;
use App\Services\Action\AvatarService;
use App\Http\Requests\Admin\AiAvatarProRequest;
use App\Services\Action\AiAvatarProActionService;

class AvatarProController extends Controller
{
    use ApiResponseTrait;
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Check Video Status
            if($request->has("checkVideoStatus") && $request->has("video_id")){

                return $this->sendResponse(
                  appStatic()::SUCCESS_WITH_DATA,
                  "Video Status",
                  (new AiAvatarProActionService())->getVideoStatus($request->video_id, getUserParentId())
                );
            }
            // Video Lists
            if($request->has("loadData")){
                $data["videos"] = (new AiAvatarProActionService())->getVideos(getUserParentId());

                return   view("backend.admin.avatar-pro.render.render-avatar-pro")->with($data)->render();
            }
        }


        return view("backend.admin.avatar-pro.index");
    }

    public function getAvatarsAndTalkingPhotos( Request $request) {
        try{
            // Ajax Requests
            if($request->ajax()){
                // Load Avatars
                $avatars = (new AvatarService())->getAvatars();
                return $this->sendResponse(
                    appStatic()::SUCCESS_WITH_DATA,
                    "Avatars Photos",
                    $avatars
                );
                
            }
        } catch(\Throwable $e){
            wLog("Failed to load avatars and talking photos", errorArray($e));
            return $this->sendResponse(
                appStatic()::VALIDATION_ERROR,
                localize("Failed to get Avatars and Talking Photos"),
                [],
                errorArray($e)
            );
        }
    }

    public function getVoices( Request $request) {
        try{
            // Ajax Requests
            if($request->ajax()){
                $voices = (new VoiceService())->getVoices();
                return $this->sendResponse(
                    appStatic()::SUCCESS_WITH_DATA,
                    "Successfully fetched the voices",
                    $voices
                );
                
            }
        } catch(\Throwable $e){
            wLog("Failed to load avatars and talking photos", errorArray($e));
            return $this->sendResponse(
                appStatic()::VALIDATION_ERROR,
                localize("Failed to get voices"),
                [],
                errorArray($e)
            );
        }
    }

    public function importVoices( Request $request) {
        try{
            $voices = (new AiAvatarProActionService())->loadVoices();
            return $this->sendResponse(
                appStatic()::SUCCESS_WITH_DATA,
                "Successfully imported the voices",
                $voices
            );
        } catch(\Throwable $e){
            wLog("Failed to load avatars and talking photos", errorArray($e));
            return $this->sendResponse(
                appStatic()::VALIDATION_ERROR,
                localize("Failed to get voices"),
                [],
                errorArray($e)
            );
        }
    }

    public function getAvatarByAvatarId(Request $request) {
        try{
            // Ajax Requests
            if($request->ajax()){
                if($request->has("avatar_id") && $request->avatar_id){
                    return $this->sendResponse(
                        appStatic()::SUCCESS_WITH_DATA,
                        "HeyGen Avatar by Avatar ID",
                        (new AiAvatarProActionService())->getAvatarByAvatarId($request->avatar_id)
                    );
                } else {
                    return $this->sendResponse(
                        appStatic()::VALIDATION_ERROR,
                        localize("Avatar ID is required"),
                        []
                    );
                }
               
            }
        } catch(\Throwable $e){
            wLog("Failed to load HeyGen Avatar by Avatar ID", errorArray($e));
            return $this->sendResponse(
                appStatic()::VALIDATION_ERROR,
                localize("Failed to get HeyGen Avatar by Avatar ID"),
                [],
                errorArray($e)
            );
        }
    }

    public function create( Request $request)
    {
        try{
            // Check Avatar Pro
            checkValidCustomerFeature(allowAiAvatarPro());

            // Ajax Requests
            if($request->ajax()){

                // Load Avatars and Talking Photos
                if($request->has("loadAvatarsAndTalkingPhotos")){

                    return $this->sendResponse(
                        appStatic()::SUCCESS_WITH_DATA,
                        "Avatars and Talking Photos",
                        view("backend.admin.avatar-pro.ajax.ajax-avatars")
                            ->with(["avatars"=>(new AiAvatarProActionService())->getAvatarsAndTalkingPhotos()["avatars"]])
                            ->render()
                    );
                }

                // Load Avatar by Avatar ID
                if($request->has("loadAvatarByAvatarId") && $request->has("avatar_id")){

                    return $this->sendResponse(
                        appStatic()::SUCCESS_WITH_DATA,
                        "HeyGen Avatar by Avatar ID",
                        (new AiAvatarProActionService())->getAvatarByAvatarId($request->avatar_id)
                    );
                }

                // List All Voices
                if($request->has("loadVoices")){

                    return $this->sendResponse(
                        appStatic()::SUCCESS_WITH_DATA,
                        "Avatars and Talking Photos",
                        view("backend.admin.avatar-pro.ajax.ajax-option")
                            ->with(["voices"=>(new AiAvatarProActionService())->loadVoices()])
                            ->render()
                    );
                }

                // List of All Videos
                if($request->has("loadVideos")){

                    return $this->sendResponse(
                        appStatic()::SUCCESS_WITH_DATA,
                        "Videos List",
                        (new AiAvatarProActionService())->getHeyGenVideos()
                    );
                }
            }

            $data["emotions"] = (new AiAvatarProActionService())->getEmotions();

            return view("backend.admin.avatar-pro.new-avatar-pro")->with($data);
        }
        catch(\Throwable $e){
            wLog("Failed to create avatar", errorArray($e));

            flashMessage($e->getMessage(), 'error');

            return redirect()->back();
        }
    }

    public function createVideo(AiAvatarProRequest $request, AiAvatarProActionService $aiAvatarProActionService)
    {

        try{
            \DB::beginTransaction();

            $avatarProVideo = $aiAvatarProActionService->createVideo($request->validated(), getUserObject());

            // Update Video Balance
            (new BalanceService())->updateVideoBalance(getUserObject(),1);

            \DB::commit();

            flashMessage(localize("Successfully created video"), 'success');

            return $this->sendResponse(
              appStatic()::SUCCESS_WITH_DATA,
              localize("Successfully created video"),
              $avatarProVideo
            );
        }
        catch(\Throwable $e){
            \DB::rollBack();
            wLog("Failed to create video", errorArray($e));

            flashMessage($e->getMessage(), 'error');

            return $this->sendResponse(
                appStatic()::NOT_FOUND,
                localize("Failed to create video"),
                [],
                errorArray($e)
            );
        }
    }

    public function getOptions()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('HEY_GEN_API_KEY'),
            ])->get('https://api.heygen.com/v2/options'); // Replace with HeyGen options API endpoint.

            if ($response->successful()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $response->json(),
                ]);
            }



            throw new \Exception("Failed to fetch options: " . $response->body());
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    
    
}
