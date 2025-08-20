<?php

namespace App\Http\Controllers\Admin\Support;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Http\Resources\Admin\Support\TicketResource;
use App\Http\Requests\Admin\Support\TicketRequestForm;
use App\Services\Model\Support\TicketService;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $ticketService;
    public function __construct()
    {
        $this->appStatic = appStatic();
        $this->ticketService = new TicketService();
    }
    public function index(Request $request)
    {
        $data = $this->ticketService->index(true, null); 
      
        if ($request->ajax()) {
            return view('backend.admin.support.tickets.list-of-ticket', $data)->render();
        }
        return view("backend.admin.support.tickets.index")->with($data);
    }
    public function store(TicketRequestForm $request)
    {
        try {
            DB::beginTransaction();
            
            $ticket = $this->ticketService->store($request->getData());

            DB::commit();

            return $this->sendResponse( 
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Successfully stored ticket"),
                TicketResource::make($ticket)
            );
        } catch (\Throwable $e) {
            DB::rollBack();

            wLog("Failed to Store ticket", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to store ticket"),
                [],
                errorArray($e)
            );
        }
    }

    /**
     * @throws \JsonException
     */
    public function edit(Ticket $ticket)
    {
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully retrieved ticket"),
            $ticket
        );
    }

    public function show(Request $request, $id)
    {
       $ticket = $this->ticketService->findTicketById($id);
       return view("backend.admin.support.tickets.show", compact('ticket'));
    }
    public function reply(Request $request, $id)
    {
       $ticket = $this->ticketService->findTicketById($id);
       return view("backend.admin.support.tickets.reply", compact('ticket'));
    }

    public function update(TicketRequestForm $request, Ticket $ticket)
    {
        $data = $this->ticketService->update($ticket, $request->getData());
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully ticket Updated"),
            TicketResource::make($data)

        );
    }
    public function destroy(Request $request, Ticket $ticket)
    {
        try {
            if ($request->ajax()) {
                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Successfully deleted ticket"),
                    $ticket->delete()
                );
            }
        } catch (\Throwable $e) {
            wLog("Failed to Delete ticket", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to Delete : ") . $e->getMessage(),
                [],
                errorArray($e)
            );
        }
    }
}