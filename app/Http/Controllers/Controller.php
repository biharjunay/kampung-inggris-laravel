<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $data = [];
    protected $model = '';
    protected $pagination_rows = 10;

    public function index(Request $request)
    {
        $model = new $this->model;
        $query = $model->query();

        $inputs = $request->all();
        $page = $inputs['page'] ?? null;
        $list = $page ? $query->paginate($this->pagination_rows) : $query->get();

        return $this->sendResponse($list);
    }

    public function show(Request $request, $id): JsonResponse
    {
        $model = new $this->model;
        $query = $model->query();
        $product = $query->findOrFail($id);
        return $this->sendResponse($product);
    }

    public function destroy($id):JsonResponse {
        $model = new $this->model;
        $query = $model->query();
        $obj = $query->findOrFail($id);
        $obj->delete();
        return $this->sendResponse('');
    }

    protected function sendResponse($result, $status = 200, $message = 'Success')
    {
        return response()->json([
            'status' => $status,
            'data' => $result,
            'message' => $message
        ], $status);
    }

    protected function sendResponsePagination($result, $status = 200, $message = 'Success') {
        return response()->json(array_merge(
            [
                'status' => $status,
                'message' => $message,
            ],
            $result->toArray()
        ), $status);
    }
    protected function sendError($error, $status)
    {
        return response()->json([
            'status' => $status,
            'error' => $error
        ], $status);
    }
}
