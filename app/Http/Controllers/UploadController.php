<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload_image(Request $request)
    {
        $inputs = $request->all();
        $validator = \Validator::make($inputs, [
            'image' => 'required|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        if ($validator->fails())
            return $this->sendError($validator->errors(), 422);

        $disk = \Storage::disk('public');
        $file = $request->file('image');
        $filename = time() . '.' . $file->extension();


        $disk->put("image/$filename", file_get_contents($file));

        return $this->sendResponse([
            'url' => "image/$filename"
        ]);
    }
}
