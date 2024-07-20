<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\error;

class AuthController extends Controller
{
    //
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            $message = 'El correo electrónico o la contraseña son incorrectos.';
            $errors = ['email' => $message];
            return response()->json(compact('message','errors'),401);
        }
        // $request->session()->regenerate();
        $user = User::where('email',$request->email)->firstOrFail();
        $accessToken = $user->createToken('auth_token')->plainTextToken;
        return response()->json(compact('user','accessToken'));
    }
}
