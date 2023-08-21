<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{
    /**
     * @param LoginRequest $request 
     * @return JsonResource
     */
    public function login(LoginRequest $request): JsonResource
    {
        if(Auth::attempt($request->all())){
            $request->session()->regenerate();
            return new UserResource(Auth::user());
        }

        throw ValidationException::withMessages([
            'loginFail' => 'IDまたはパスワードが違います。',
        ]);
    }
}
