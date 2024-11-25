<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected $model = Brand::class;
    public function store(Request $request): JsonResponse
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'image_url' => 'required'
        ]);

        if ($validator->fails())
            return $this->sendError($validator->errors(), 422);
        $brand = Brand::create($request->all());
        return $this->sendRespose($brand);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'image_url' => 'required'
        ]);
        if ($validator->fails())
            return $this->sendError($validator->errors(), 422);

        $brand = Brand::findOrFail($id);
        if ($request->has('image_url') && $request->imageUrl !== $brand->image_url) {
            $disk = \Storage::disk('public');
            if ($disk->exists($brand->image_url))
                $disk->delete($brand->image_url);
            $brand->image_url = $request->image_url;
        }
        $brand->fill($request->all());
        $brand->save();
        return $this->sendResponse($brand);
    }

    public function destroy($id): JsonResponse
    {
        $brand = Brand::findOrFail($id);
        $disk = \Storage::disk('public');
        if ($disk->exists($brand->image_url))
            $disk->delete($brand->image_url);
        $brand->delete();
        return $this->sendResponse('');
    }
}
