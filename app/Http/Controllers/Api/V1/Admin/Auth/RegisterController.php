<?php

namespace App\Http\Controllers\Api\V1\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(StoreRegisterRequest $request)
    {
        $userData = $request->only('name', 'email', 'password');
        $userData['password'] = bcrypt($userData['password']);
        $user = new User;

        if(!$user = $user->create($userData)){
            abort(500, 'Error ao criar novo usuário');
        }

        return response()->json([
            'data' => [
                'user' => $user,
            ]
        ], 200);
    }
}
