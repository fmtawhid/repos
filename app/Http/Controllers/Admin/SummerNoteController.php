<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\File\FileUploadTrait;

class SummerNoteController extends Controller
{
    use FileUploadTrait;
    public function summernoteFileUpload(Request $request)
    {
        try {
           
            $filePath = $this->uploadFile($request->media_file, fileService()::DIR_MEDIA);
            if (file_exists($filePath)) {
                return response()->json(['status' => true, 'file' => asset($filePath), 'msg' => 'success']);
            }
            return response()->json(['status' => false, 'file' => '', 'msg' => 'error']);
            
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'file' => '', 'msg' => $th->getMessage()]);
        }
    }
}
