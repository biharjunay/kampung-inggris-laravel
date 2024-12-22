<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Storage;

class TestimonialController extends Controller
{
    protected $model = Testimonial::class;

    public function beforeCreateValidation(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'profession' => 'required',
            'message' => 'required',
            'rating' => 'required',
            'program_name' => 'required',
            'video_url' => 'required',
            'image_url' => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->has('image_url') && $request->image_url) {
                $disk = Storage::disk('public');
                if ($disk->exists($request->image_url))
                    $disk->delete($request->image_url);
            }
            return $validator->errors();
        }
    }

    public function beforeUpdateValidation(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'profession' => 'required',
            'rating' => 'required',
            'program_name' => 'required',
            'message' => 'required',
            'video_url' => 'required',
            'image_url' => 'required'
        ]);

        if ($validator->fails())
            return $validator->errors();
    }

    public function beforeUpdate($input, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        if ($input->has('image_url') && $input->image_url !== $testimonial->image_url) {
            $disk = Storage::disk('public');
            if ($disk->exists($testimonial->image_url))
                $disk->delete($testimonial->image_url);
        }
        return $input;
    }
}
