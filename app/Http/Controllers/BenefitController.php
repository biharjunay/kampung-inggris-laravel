<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BenefitController extends Controller
{
    protected $model = Benefit::class;

    protected $relation_rule = ['products'];
    protected function customSearch(Request $request, $query)
    {
        if ($request->has('product_id')) {
            $query->whereHas('products', function ($q) use ($request) {
                $q->where('products.id', $request->product_id);
            });
        }

        return $query;
    }

    public function store(Request $request): JsonResponse
    {
        $validator = \Validator::make($request->all(), [
            "name" => "required|string",
            "description" => "required|string",
            "icon_url" => "required|string",
        ]);

        if ($validator->fails())
            return $this->sendError($validator->errors(), 422);

        $benefit = Benefit::create($request->all());
        return $this->sendResponse($benefit);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = \Validator::make($request->all(), [
            "name" => "required|string",
            "description" => "required|string",
            "icon_url" => "required|string",
        ]);

        if ($validator->fails())
            return $this->sendError($validator->errors(), 422);

        $benefit = Benefit::findOrFail($id);
        $benefit->fill($request->all());
        $benefit->save();
        return $this->sendResponse($benefit);
    }
}
