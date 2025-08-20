<?php

namespace App\Http\Controllers\Admin\MediaManager;

use Illuminate\Support\Str;
use App\Models\MediaManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\File\FileUploadTrait;

class UppyMediaController extends Controller
{
    use FileUploadTrait;
    # get media files
    public function index(Request $request)
    {
        $searchKey  = null;
        $type       = null;

        $mediaFiles = MediaManager::query()->latest();
       
        if (isAdmin()) {
            $mediaFiles = $mediaFiles->where('user_id', userId());
        }

        if ($request->has("type") && $request->type != 'all') {
            $mediaFiles = $mediaFiles->where('media_type', $type);
        }

        $recentFiles = $mediaFiles->take(3)->get();
        $recentFileIds = $recentFiles->pluck('id');

        if ($request->searchKey != null) {
          
            $searchKey = $request->searchKey;
            $mediaFiles = $mediaFiles->where('media_name', 'like', '%' . $request->searchKey . '%');
        }

        $mediaFiles  = $mediaFiles->whereNotIn('id', $recentFileIds)->paginate(maxPaginateNo())->appends(request()->query());

        return [
            'status' => true,
            'recentFiles' => view('common.media-manager.recent', compact('recentFiles'))->render(),
            'mediaFiles' => view('common.media-manager.previous', compact('mediaFiles'))->render(),
            'mediaQuery' => $mediaFiles
        ];
    }

    # get selected media files
    public function selectedFiles(Request $request)
    {
        $mediaFiles = MediaManager::whereIn('id', $request->mediaIds)->get();
        return [
            'status' => true,
            'mediaFiles' => view('common.media-manager.image', compact('mediaFiles'))->render()
        ];
    }

    # store media file to media manager
    public function store(Request $request)
    {
        try {
            if ($request->hasFile('media_file')) {
                $filePath = $this->fileProcess($request->media_file, fileService()::DIR_MEDIA, false, $height = 800, $width  = 800,$fileOriginalName = true);
                $mediaFile = new MediaManager;
                $mediaFile->user_id = userId();    
                $mediaFile->media_file = $filePath;
                $mediaFile->media_name = $request->file('media_file')->getClientOriginalName();
                $mediaFile->media_extension = $request->file('media_file')->getClientOriginalExtension();    
                if (getFileType(Str::lower($mediaFile->media_extension)) != null) {
                    $mediaFile->media_type = getFileType(Str::lower($mediaFile->media_extension));
                } else {
                    $mediaFile->media_type = "unknown";
                }
                $mediaFile->save();
                return true;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    # delete media
    public function delete($id)
    {
        $mediaFile = MediaManager::findOrFail($id);
        if (!is_null($mediaFile)) {
            fileDelete($mediaFile->media_file);
            $mediaFile->delete();
        }
        return redirect()->route('admin.mediaManager.index');
    }
}
