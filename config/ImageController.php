<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $inputs = $request->all();
        $validator = \Validator::make($inputs, [
            'image' => 'required|mimes:png,jpg,jpeg',
        ]);
        if ($validator->fails())
            return $this->sendError($validator->errors());

        $disk = \Storage::disk('public');
        $file = $request->file('image');
        // $namaFile = $file->getClientOriginalName();
        $filename = time() . '.' . $file->extension();

        $disk->put($filename, file_get_contents($file));

        return response()->json([
            'status' => 'success',
            'url' => $filename
        ], 200);

    }
}
