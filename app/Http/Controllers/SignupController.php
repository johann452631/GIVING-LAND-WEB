<?php

namespace App\Http\Controllers;

use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Requests\NewEmailRequest;
use App\MyOwn\classes\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only(['index','codeForm']);
        $this->middleware(EnsureTokenIsValid::class)->only(['codeForm']);
    }

    public function index()
    {
        session(['token' => bin2hex(random_bytes(16))]);
        return view('sections.signup.index', [
            'rutaSiguiente' => 'signup.sendCode',
            'content' => 'email',
            'token' => session('token')
        ]);
    }

    public function sendCode(NewEmailRequest $request)
    {
        session(['hashed' => Utility::sendVerificationCode($request->email)]);
        return to_route('signup.codeForm', $request->only(['email', 'token']));
    }

    public function codeForm(Request $request)
    {
        return view('sections.signup.index', [
            'content' => 'code',
            'rutaSiguiente' => 'signup.verifyCode',
            'request' => $request,
        ]);
    }

    public function verifyCode(Request $request)
    {
        $inputCode = strtoupper(implode("", $request->except(['_token', 'token', 'email'])));
        if (Hash::check($inputCode, session('hashed'))) {
            session()->forget('hashed');
            session(['token' => bin2hex(random_bytes(16))]);
            $request->merge(['token' => session('token')]);
            Utility::sendAlert('success','Se verificó su correo');
            return to_route('users.create',$request->only(['email','token']));
        }
        return back()->with('errorVerificacion', "El código no coincide");
    }
}
