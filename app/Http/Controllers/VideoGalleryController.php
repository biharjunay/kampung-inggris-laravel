<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VideoGallery;

class VideoGalleryController extends Controller
{
    protected $model = VideoGallery::class;

    protected function beforeCreateValidation(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'subtitle' => 'required',
            'message' => 'required',
            'participant_name' => 'required',
            'program_name' => 'required',
            'thumbnail_url' => 'required',
            'video_url' => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->has('thumbnail_url') && $request->thumbnail_url) {
                $disk = \Storage::disk('public');
                if ($disk->exists($request->thumbnail_url))
                    $disk->delete($request->thumbnail_url);
            }
            return $validator->errors();
        }
    }

    protected function beforeUpdateValidation(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'subtitle' => 'required',
            'message' => 'required',
            'participant_name' => 'required',
            'program_name' => 'required',
            'thumbnail_url' => 'required',
            'video_url' => 'required',
        ]);
        if ($validator->fails())
            return $validator->errors();
    }
}
