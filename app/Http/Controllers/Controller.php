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

    protected $relation_rule = [];

    public function index(Request $request)
    {
        $model = new $this->model;
        $query = $model->query();

        $inputs = $request->all();

        $query = $this->customSearch($request, $query);

        if (count($this->relation_rule) > 0) {
            foreach ($this->relation_rule as $rv) {
                $query->with($rv);
            }
        }

        $page = $inputs['page'] ?? null;

        if ($page) {
            $list = $query->paginate($this->pagination_rows);
            return $this->sendResponsePagination($list);
        }

        $list = $query->get();
        return $this->sendResponse($list);
    }


    public function show(Request $request, $id): JsonResponse
    {
        $model = new $this->model;
        $query = $model->query();

        $query = $this->customDetail($request, $id, $query);

        $product = $query->findOrFail($id);
        return $this->sendResponse($product);
    }

    public function store(Request $request): JsonResponse
    {
        $firstRequest = $request;
        $invalid = $this->beforeCreateValidation($request);

        if (!empty($invalid))
            return $this->sendError($invalid, 422);

        $request = $this->beforeCreate($request);
        $model = new $this->model;
        $result = $model::create($request->all());
        $this->afterCreate($request, $result, $firstRequest);

        return $this->sendResponse($result);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $invalid = $this->beforeUpdateValidation($request);

        if (!empty($invalid))
            return $this->sendError($invalid, 422);
        $request = $this->beforeUpdate($request, $id);
        $model = new $this->model;
        $data = $model->findOrFail($id);
        $data->fill($request->all());
        $data->save();
        $this->afterUpdate($data);
        return $this->sendResponse($data);
    }

    public function destroy($id): JsonResponse
    {
        $model = new $this->model;
        $query = $model->query();
        $this->beforeDelete($id);
        $obj = $query->findOrFail($id);
        $obj->delete();
        return $this->sendResponse('');
    }

    protected function beforeCreateValidation(Request $request)
    {
        return null;
    }

    protected function beforeCreate(Request $request)
    {
        return $request;
    }

    protected function afterCreate($request, $result, $firstRequest)
    {
    }

    protected function beforeUpdateValidation(Request $request)
    {
        return null;
    }

    protected function beforeUpdate($input, $id)
    {
        return $input;
    }

    protected function beforeDelete($id)
    {

    }

    protected function afterUpdate($input)
    {
    }

    protected function beforeSearch()
    {
    }

    protected function customSearch(Request $request, $query)
    {
        return $query;
    }

    protected function customDetail($request, $id, $query)
    {
        return $query;
    }

    protected function sendResponse($result, $status = 200, $message = 'Success')
    {
        return response()->json([
            'status' => $status,
            'data' => $result,
            'message' => $message
        ], $status);
    }

    protected function sendResponsePagination($result, $status = 200, $message = 'Success')
    {
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
