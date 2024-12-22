<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    protected $model = Hero::class;

    public function index(Request $request)
    {
        $list = Hero::all();
        $list = collect($list)->mapWithKeys(function ($item) {
            return [
                $item['key'] => [
                    'value' => $item['value'] ?? '',
                    'image_url' => $item['image_url'] ?? '',
                    'redirect_to' => $item['redirect_to'] ?? '',
                    'description' => $item['description'] ?? '',
                ],
            ];
        });
        return $this->sendResponse($list);
    }

    public function store(Request $request): JsonResponse
    {
        $validators = \Validator::make($request->all(), [
            'key' => 'required',
            'image_url' => ['nullable', 'required_without:value', 'string'],
            'value' => ['nullable', 'required_without:image_url', 'string'],
        ]);

        if ($validators->fails())
            return $this->sendError($validators->errors(), 422);

        $hero = Hero::where('key', $request->key)->first();
        if (!$hero)
            $hero = Hero::create($request->all());
        else {
            if ($request->has('image_url') && $request->image_url !== $hero->image_url) {
                $disk = \Storage::disk('public');
                if ($disk->exists($hero->image_url))
                    $disk->delete($hero->image_url);

                $hero->image_url = $request->image_url;
            }
            $hero->fill($request->all());
            $hero->save();
        }

        return $this->sendResponse($hero, 201);
    }
}
