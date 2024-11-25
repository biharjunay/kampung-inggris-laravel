<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    protected $model = Program::class;

    public function store(Request $request): JsonResponse {
        $validator = \Validator::make($request->all(), [
            'product_id'    => 'required|exists:products,id',
            'type_id'       => 'required',
            'name'          => 'required|string|max:255',
            'total_student' => 'required_if:type_id,1|integer',
            'review'        => 'required_if:type_id,2|string',
            'total_minute'  => 'required_if:type_id,2|integer',
            'price'         => 'required|numeric|min:0',
            'discount_type' => 'nullable|in:percentage,flat',
            'discount'      => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails())
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);


        $data = $request->all();
        $program = Program::create($data);

        return $this->sendResponse($program);
    }

    public function update(Request $request, $id): JsonResponse {
        $validator = \Validator::make($request->all(), [
            'product_id'    => 'required|exists:products,id',
            'type_id'       => 'required',
            'name'          => 'required|string|max:255',
            'total_student' => 'required_if:type_id,1|integer',
            'review'        => 'required_if:type_id,2|string',
            'total_minute'  => 'required_if:type_id,2|integer',
            'price'         => 'required|numeric|min:0',
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
