<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $model = Article::class;

    protected function beforeCreateValidation(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'url' => 'required',
            'image_url' => 'required'
        ]);

        if ($validator->fails()) {
            if ($request->has('image_url') && $request->image_url) {
                $disk = \Storage::disk('public');
                if ($disk->exists($request->image_url))
                    $disk->delete($request->image_url);
            }
            return $validator->errors();
        }
    }

    protected function beforeCreate(Request $request) {
        $request['published_by'] = $request->user()->name;
        return $request;
    }
    // public function store(Request $request): JsonResponse {
    //     $validator = \Validator::make($request->all(), [
    //         'name' => 'required',
    //         'user_id' => 'exists:users,id',
    //         'description' => 'required',
    //         'url' => 'required',
    //         'published_by' => 'required'
    //     ]);

    //     if ($validator->fails()) return $this->sendError($validator->errors(), 422);

    //     $article = Article::make($request->all());
    //     return $this->sendResponse($article, 201);
    // }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'url' => 'required',
            'published_by' => 'required'
        ]);

        if ($validator->fails())
            return $this->sendError($validator->errors(), 422);

        $article = Article::findOrFail($id);
        $article->fill($request->all());
        $article->save();
        return $this->sendResponse($article, 201);
    }
}
