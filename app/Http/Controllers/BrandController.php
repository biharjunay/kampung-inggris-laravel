<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected $model = Brand::class;

    public function beforeCreateValidation(Request $request) {
        $validator = \Validator::make($request->all(), [
            'image_url' => 'required'
        ]);
        if ($validator->fails()) return $validator->errors();
    }

    public function beforeUpdateValidation(Request $request) {
        $validator = \Validator::make($request->all(), [
            'image_url' => 'required'
        ]);
        if ($validator->fails()) return $validator->errors();
    }

    public function beforeUpdate($input, $id) {
        $brand = Brand::findOrFail($id);
        if ($input->has('image_url') && $input->imageUrl !== $brand->image_url) {
            $disk = \Storage::disk('public');
            if ($disk->exists($brand->image_url))
                $disk->delete($brand->image_url);
        }
        return $input;
    }

    public function beforeDelete($id)
    {
        $brand = Brand::findOrFail($id);
        $disk = \Storage::disk('public');
        if ($disk->exists($brand->image_url))
            $disk->delete($brand->image_url);
    }
}
