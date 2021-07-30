<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\CustomUser;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function create(CreateUserRequest $request)
    {
        dd(Redis::keys('*'));
        $answer = (new CustomUser($request->email, $request->password))->save()
        ? 'User created!'
        : 'User already exists!';

        return response()->json($answer, 200);
    }

    public function login(LoginUserRequest $request)
    {
        $token = (new CustomUser($request->email, $request->password))->setToken();
        return response()->json([
            'token' => $token
        ], 200);
    }
}
