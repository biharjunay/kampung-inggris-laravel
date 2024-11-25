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
    public function index(Request $request)
    {
        $product = Product::query();
        $product_type = $request->query('type');

        if (!empty($product_type) && $product_type != null)
            $product->where('type_id', $product_type);

        $product
            ->with(['type'])
            ->withCount('benefits')
            ->withAvg('ratings', 'rating')
            ->addSelect([
                'total-student' => Program::select('total_student')
                    ->whereColumn('programs.product_id', 'products.id')
                    ->orderByDesc('total_student')
                    ->limit(1)
            ]);

        $inputs = $request->all();
        $page = $inputs['page'] ?? null;

        if ($page) {
            $list = $product->paginate(10);
            return $this->sendResponsePagination($list);
        }
        $list = $product->get();

        return $this->sendResponse($list, 200);
    }

    public function show(Request $request, $id): JsonResponse
    {
        $product = Product::with(['benefits', 'programs', 'type'])->findOrFail($id);
        return $this->sendResponse($product);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = \Validator::make($request->all(), [
            'name'       => 'required',
            'image_url'  => 'required',
            'type_id'    => 'required',
            'benefits'   => 'required|array',
            'benefits.*' => 'exists:benefits,id'
        ]);

        if ($validator->fails())
            return $this->sendError($validator->errors(), 400);

        $data = $request->except('benefits');
        $product = Product::create($data);

        if ($request->has('benefits') && is_array($request->benefits)) {
            $product->benefits()->sync($request->benefits);
        }

        return $this->sendResponse($product);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = \Validator::make($request->all(), [
            'name'       => 'required',
            'image_url'  => 'required',
            'type_id'    => 'required',
            'benefits'   => 'required|array',
            'benefits.*' => 'exists:benefits,id'
        ]);

        if ($validator->fails())
            return $this->sendError($validator->errors(), 400);

        $product = Product::findOrFail($id);
        // $disk = Storage::disk('public');
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

    public function destroy($id): JsonResponse
    {
        $product = Product::findOrFail($id);
        Storage::delete("public/$product->image_url");
        $product->delete();
        return $this->sendResponse('');
    }

}
