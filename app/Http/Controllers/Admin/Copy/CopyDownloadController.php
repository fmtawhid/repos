<?php

namespace App\Http\Controllers\Admin\Copy;

use App\Mail\EmailManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Chat\ChatService;
use Illuminate\Support\Facades\Mail;

class CopyDownloadController extends Controller
{
    protected $chatService;

    public function __construct()
    {
        $this->chatService = new ChatService();
    }
    # SEND IN EMAIL
    public function sendInEmail(Request $request)
    {
        if ($request->email == null) {
            flash(localize('Please type an email'))->error();
            return back();
        }

        $conversation = AiChat::findOrFail((int) $request->conversation_id);
        if (is_null($conversation)) {
            flash(localize('Chat not found'))->error();
            return back();
        }

        try {
            $array['view'] = 'emails.chat';
            $array['from'] = env('MAIL_FROM_ADDRESS');
            $array['subject'] = $conversation->title;
            $array['conversation'] = $conversation;
            $array['messages'] = $conversation->messages;

            Mail::to($request->email)->queue(new EmailManager($array));
            flash(localize('Chat successfully sent to email'))->success();
        } catch (\Throwable $th) {
            flash($th->getMessage())->error();
        }
        return back();
    }
    // download, copy chat history
    public function downloadChatHistory(Request $request)
    {

        try {
            $basePath = public_path('/');
            $type = $request->type;
            $conversation = AiChat::whereId((int) $request->chatId)->with('messages')->first();
            $messages = null;
            $name   = $conversation->category ? $conversation->category->name : 'ai_chat';

            if ($conversation) {
                $messages  = $conversation->messages;
            }

            if (!$messages) {
                flash(localize('No Message Fund'));
                return redirect()->back();
            }
            $data = ['messages' => $messages, 'conversation' => $conversation, 'type' => $type];
            if ($type == 'html') {
                $name =  str_replace(' ', '_', $name) . '.html';
                $file_path = $basePath . $name;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }

                $view = view('backend.admin.download.chat.index', $data)->render();
                file_put_contents($file_path, $view);
                return response()->download($file_path);
            }
            if ($type == 'word') {
                $name =  str_replace(' ', '_', $name) . '.doc';
                $file_path = $basePath . $name;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }

                $view = view('backend.admin.download.chat.index', $data)->render();
                file_put_contents($file_path, $view);
                return response()->download($file_path);
            }
            if ($type == 'pdf') {
                return  view('backend.admin.download.chat.index', $data);
            }

            if ($type == 'copyChat') {
                return  view('backend.admin.download.chat.copy', $data);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
