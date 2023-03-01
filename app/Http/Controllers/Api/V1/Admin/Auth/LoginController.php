<?php

namespace App\Http\Controllers\Api\V1\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{ 
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        //dd($credentials);
        if(!auth()->attempt($credentials))
        {
            abort(401, 'Invalid Crendentials');
        }
        
        $token = auth()->user()->createToken('auth_token');
        return response()->json([
            'data' => [
                'token' => $token->plainTextToken
                ]
            ], 200);
    }
        
    public function logout()
    {
        //remove todos os tokens do usuario
        //auth()->user()->tokens()->delete();
        
        //remove apenas o token da requisicao
        auth()->user()->currentAccessToken()->delete();
        
        return response()->json([], 204);
    }
}
    
    