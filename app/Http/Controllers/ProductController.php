<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Program;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;
use Storage;

class ProductController extends Controller
{
    protected $model = 'App\Models\Product';

    protected function customSearch(Request $request, $query)
    {
        $product_type = $request->query('type');

        if (!empty($product_type) && $product_type != null)
            $query->where('type_id', $product_type);

        $query
            ->with(['type'])
            ->withCount('benefits')
            ->addSelect([
                'total_student' => Program::select('total_student')
                    ->whereColumn('programs.product_id', 'products.id')
                    ->orderByDesc('total_student')
                    ->limit(1),
                'reviews' => Program::select('review')
                    ->whereColumn('programs.product_id', 'products.id')
                    ->orderByDesc('review')
                    ->limit(1)
            ]);

        return $query;
    }

    public function show(Request $request, $id): JsonResponse
    {
        $product = Product::with(['benefits', 'programs', 'type'])->findOrFail($id);
        return $this->sendResponse($product);
    }

    public function beforeCreateValidation(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'image_url' => 'required',
            'type_id' => 'required',
            'benefits' => 'required|array',
            'benefits.*' => 'exists:benefits,id'
        ]);

        if ($validator->fails())
            return $validator->errors();
    }

    public function store(Request $request): JsonResponse
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'image_url' => 'required',
            'type_id' => 'required',
            'benefits' => 'required|array',
            'benefits.*' => 'exists:benefits,id',
            'rating' => 'required|numeric|between:1,5'
        ]);

        if ($validator->fails()) {
            if ($request->has('image_url') && $request->image_url) {
                $disk = Storage::disk('public');
                if ($disk->exists($request->image_url))
                    $disk->delete($request->image_url);
            }
            return $this->sendError($validator->errors(), 400);
        }

        $data = $request->except('benefits');
        $data['published_by'] = $request->user()->name;
        $product = Product::create($data);

        if ($request->has('benefits') && is_array($request->benefits)) {
            $product->benefits()->sync($request->benefits);
        }
        if ($request->has('image_url') && $request->image_url !== $product->image_url) {
            $disk = Storage::disk('public');
            if ($disk->exists($product->image_url))
                $disk->delete($product->image_url);

            $product->image_url = $request->image_url;
        }

        return $this->sendResponse($product);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'image_url' => 'required',
            'type_id' => 'required',
            'benefits' => 'required|array',
            'benefits.*' => 'exists:benefits,id',
            'rating' => 'required|numeric|between:1,5'
        ]);

        if ($validator->fails())
            return $this->sendError($validator->errors(), 400);

        $product = Product::findOrFail($id);
        if ($request->has('image_url') && $request->image_url !== $product->image_url) {
            $disk = Storage::disk('public');
            if ($disk->exists($product->image_url))
                $disk->delete($product->image_url);

            $product->image_url = $request->image_url;
        }
        $product->fill($request->except(['benefits', 'image_url']));

        $product->save();

        if ($request->has('benefits') && is_array($request->benefits)) {
            $product->benefits()->sync($request->benefits);
        }

        return $this->sendResponse($product);
    }

    // public function destroy($id): JsonResponse
    // {
    //     $product = Product::findOrFail($id);
    //     Storage::delete("public/$product->image_url");
    //     $product->delete();
    //     return $this->sendResponse('');
    // }
    protected function beforeDelete($id)
    {
        $product = Product::findOrFail($id);
        Storage::delete("public/$product->image_url");
    }

}
