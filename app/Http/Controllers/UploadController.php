<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload_image(Request $request)
    {
        $inputs = $request->all();
        $validator = \Validator::make($inputs, [
            'image' => 'required|mimes:png,jpg,jpeg',
        ]);
        if ($validator->fails())
            return $this->sendError($validator->errors(), 422);

        $disk = \Storage::disk('public');
        $file = $request->file('image');
        $filename = time() . '.' . $file->extension();

        $disk->put("image/$filename", file_get_contents($file));

        return response()->json([
            'status' => 'success',
            'url' => "image/$filename"
        ], 200);

    }
}
