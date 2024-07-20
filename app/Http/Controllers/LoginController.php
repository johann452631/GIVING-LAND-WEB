<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\MyOwn\classes\Utility;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     */

    public function __construct()
    {
        $this->middleware('guest')->only(['index']);
    }

    public function index()
    {
        return view('sections.login.index');
    }

    public function attempt(Request $request): RedirectResponse
    {
        $credentials = $request->only(['email', 'password']);

        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
        //     Utility::sendAlert('success', 'Se inició sesión.');
        //     return to_route('home');
        // }
        // return back()->withErrors(['email' => 'El correo electrónico o la contraseña no coinciden'])->onlyInput('email');

        $response = Http::acceptJson()->post('test.com/v1/login', $credentials);

        if (!$response->successful()) {
            return back()->withErrors($response->json()['errors'])->onlyInput('email');
        }

        Auth::login(User::find($response->json()['user']['id']));
        $request->session()->regenerate();
        Utility::sendAlert('success', 'Se inició sesión.');
        return to_route('home');
    }
}
