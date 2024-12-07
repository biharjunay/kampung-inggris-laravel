<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    protected $model = User::class;

    public function __construct()
    {
        $this->middleware('superadmin');
    }

    public function beforeCreateValidation(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:8'
        ]);
        if ($validator->fails())
            return $validator->errors();
    }

    public function beforeCreate(Request $request)
    {
        $request->password = Hash::make($request->password);
        return $request;
    }

    public function update(Request $request, $id): JsonResponse
    {
        $user = User::findOrFail($id);

        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => ['required', Rule::unique('users', 'email')->ignore($id)],
        ]);

        if ($validator->fails()) return $this->sendError($validator->errors(), 422);

        $request->password = Hash::make($request->password);

        $user->fill($request->all());
        $user->save();

        return $this->sendResponse($user);
    }

    public function beforeUpdate($input, $id)
    {
        $input->password = Hash::make($input->password);
        return $input;
    }
}
