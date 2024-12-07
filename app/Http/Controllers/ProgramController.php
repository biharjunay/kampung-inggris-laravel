<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    protected $model = Program::class;

    public function customSearch(Request $request, $query)
    {
        $product_id = $request->query('product_id');
        if ($product_id)
            $query->where('product_id', $product_id);
        return $query;
    }

    public function store(Request $request): JsonResponse
    {
        $validator = \Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'type_id' => 'required',
            'name' => 'required|string|max:255',
            'total_student' => 'required_if:type_id,1|integer',
            'review' => 'required_if:type_id,2|string',
            'total_minute' => 'required_if:type_id,2|integer',
            'price' => 'required|numeric|min:0',
            'discount_type' => 'nullable|in:percentage,flat',
            'discount_price' => 'nullable|numeric|min:0|lte:price',
        ]);

        if ($validator->fails())
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);


        $request['discount_percentage'] = ($request->discount_price ?? 0) > 0 ? (($request->price - $request->discount_price) / $request->price) * 100 : 0;
        $data = $request->all();
        $program = Program::create($data);

        return $this->sendResponse($program);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = \Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'type_id' => 'required',
            'name' => 'required|string|max:255',
            'total_student' => 'required_if:type_id,1|integer',
            'review' => 'required_if:type_id,2|string',
            'total_minute' => 'required_if:type_id,2|integer',
            'price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails())
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);

        $program = Program::findOrFail($id);
        $program->fill($request->all());
        $program->save();
        return $this->sendResponse($program);
    }
}
