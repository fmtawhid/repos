<?php

namespace App\Services\Model\Support;

use App\Models\Ticket;
use App\Models\TicketFile;
use App\Models\ReplyTicket;

class ReplyService
{
    public function store($request)
    {
        $ticket = Ticket::where('id', $request->ticket_id)->first();
        if ($ticket->is_active != 1) {
            flash(localize('Ticket Closed'))->warning();
            return redirect()->back();
        }
        $model = ReplyTicket::create($this->formatParams($request));
        $files = $request->file('files');
        if ($files) {
            $this->storeImages($files, $model->id, $request->ticket_id);
        }
        return $model;
   
    }
    private function formatParams($request, $model = null): array
    {
        $params = [
            'ticket_id' => $request->ticket_id,
            'replied' => $request->description
        ];
        if ($model) {
            $params['updated_by'] = auth()->user()->id;
        } else {
            $params['replied_by'] = auth()->user()->id;
        }

        return $params;
    }
    private function storeImages($image, $modelId, $ticket_id = null)
    {
        $path = 'public/uploads/ticket/reply/';

        $storeImage = new TicketFile();
        $storeImage->ticket_id = $ticket_id;
        $storeImage->replied_id = $modelId;
        $storeImage->file_path = $this->fileUpload($path, $image);
        $storeImage->save();
    }
    public  function fileUpload($path, $file, $change_name = false)
    {

        $fileName = '';
        if (!$file) {
            return $fileName;
        }

        $original_name = $file->getClientOriginalName();
        if ($change_name) {
            $name = $original_name;
        } else {
            $str = str_replace(' ', '-', $original_name);
            $name = time() . '_' . $str;
        }

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file->move($path, $name);
        $fileName = $path . $name;

        return $fileName;
    }
}
