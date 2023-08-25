<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @param Request $request 
     * @return JsonResource
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    /**
     * @param LoginRequest $request 
     * @return JsonResource
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt($request->all())) {
            $request->session()->regenerate();

            $token = auth()->user()->createToken('auth_token')->plainTextToken;

            return response()->json([
                'user' => new UserResource(Auth::user()),
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }

        throw ValidationException::withMessages([
            'loginFail' => 'IDまたはパスワードが違います。',
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
