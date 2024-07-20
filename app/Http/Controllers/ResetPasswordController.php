<?php

namespace App\Http\Controllers;

use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Requests\EmailResetPasswordRequest;
use App\Http\Requests\NewPasswordRequest;
use App\Models\User;
use App\MyOwn\classes\Utility;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Passwords\DatabaseTokenRepository;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only(['index', 'codeForm']);
        $this->middleware(EnsureTokenIsValid::class)->only(['codeForm','newPasswordForm']);
    }

    public function index()
    {
        session(['token' => bin2hex(random_bytes(16))]);
        return view('sections.resetpassword.index', [
            'content' => 'email',
            'rutaSiguiente' => 'resetPassword.sendCode',
            'token' => session('token')
        ]);
    }

    public function sendCode(EmailResetPasswordRequest $request)
    {
        session(['hashed' => Utility::sendVerificationCode($request->email)]);
        return to_route('resetPassword.codeForm', $request->only(['email', 'token']));
    }

    public function codeForm(Request $request)
    {
        return view('sections.resetpassword.index', [
            'content' => 'code',
            'rutaSiguiente' => 'resetPassword.verifyCode',
            'request' => $request
        ]);
    }

    public function verifyCode(Request $request)
    {
        $inputCode = strtoupper(implode("", $request->except(['_token', 'token', 'email'])));
        if (Hash::check($inputCode, session('hashed'))) {
            session()->forget('hashed');
            $tokenRepository = new DatabaseTokenRepository(DB::connection(), new BcryptHasher(), 'password_reset_tokens', 'bcrypt ');
            $token =  $tokenRepository->create(Password::getUser($request->only('email')));
            session(['token' => $token]);
            $request->merge(['token' => $token]);
            Utility::sendAlert('success', 'Se verificó su correo');
            return to_route('resetPassword.newPasswordForm', $request->only(['email', 'token']));
        }
        return back()->with('errorVerificacion', "El código no coincide");
    }

    public function newPasswordForm(Request $request)
    {
        return view('sections.resetpassword.new-password', [
            'rutaSiguiente' => 'resetPassword.saveNewPassword',
            'request' => $request,
        ]);
    }

    public function saveNewPassword(NewPasswordRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            Utility::sendAlert('success', 'Se restauró la contraseña.');
            return to_route('login.index');
        } else {
            return back()->withErrors(['email' => [__($status)]]);
        }
    }
}
