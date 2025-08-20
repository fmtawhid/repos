<?php

namespace App\Http\Controllers\Admin\Support;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Services\Model\Support\ReplyService;

class TicketReplyController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $replyService;
    public function __construct()
    {
        $this->appStatic = appStatic();
        $this->replyService = new ReplyService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        try {
            $ticket = $this->replyService->store($request);
            return $this->sendResponse( 
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Ticket reply Successfully"),
            );
        } catch (\Throwable $e) {

            wLog("Failed to Store ticket", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to reply"),
                [],
                errorArray($e)
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
