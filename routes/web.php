<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangeEmailController;
use App\Http\Controllers\CodeValidationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SecurityPrivacyController;
use App\Http\Controllers\SettlementController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Models\Image;
use App\Models\Profile;
use App\Models\Settlement;
use App\Models\User;
use App\MyOwn\classes\Utility;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::view('/', 'welcome');

Route::get('p', function () {
    dd(Http::get('test.com/v1/prueba')->body());
});


Route::get('/all', function () {
    dd(session()->all());
});
Route::get('/invalidate', function () {
    return session()->invalidate();
});

Route::get('/regenerate', function () {
    return session()->regenerate();
});

Route::get('/vp', function () {
    // return view('vp')->fragment('dos');
});

Route::get('/', function () {
    return to_route('home');
});

Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/google-auth/callback', function () {
    $user_google = Socialite::driver('google')->stateless()->user();
    $user = User::where('email', $user_google->email)->get()->first();
    if ($user === null) {
        $user = User::create([
            'name' => $user_google->name,
            'email' => $user_google->email,
        ]);
        $user->update(['username' => Utility::generateUsername($user->name)]);
        $user->profile()->save(Profile::create(['google_avatar' => $user_google->avatar]));
    }
    Utility::sendAlert('success', 'Se ingresó con su cuenta de Google');
    Auth::login($user);
    Session()->regenerate();
    return to_route('home');
});

Route::controller(AppController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::post('/logout', 'logout')->name('app.logout');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login.index');
    Route::post('/login', 'attempt')->name('login.attempt');
});

Route::controller(ResetPasswordController::class)->group(function () {
    Route::get('/reset-password', 'index')->name('resetPassword.index');
    Route::post('/reset-password/send-code', 'sendCode')->name('resetPassword.sendCode');
    Route::get('/reset-password/code-form/{token}', 'codeForm')->name('resetPassword.codeForm');
    Route::post('/reset-password/verify-code', 'verifyCode')->name('resetPassword.verifyCode');
    Route::get('/reset-password/new-password-form/{token}', 'newPasswordForm')->name('resetPassword.newPasswordForm');
    Route::post('/reset-password/save-new-password', 'saveNewPassword')->name('resetPassword.saveNewPassword');
});

Route::controller(SignupController::class)->group(function () {
    Route::get('/signup/index', 'index')->name('signup.index');
    Route::post('/signup/send-code', 'sendCode')->name('signup.sendCode');
    Route::get('/signup/code-form/{token}', 'codeForm')->name('signup.codeForm');
    Route::post('/signup/verify-code', 'verifyCode')->name('signup.verifyCode');
});

Route::get('users/create/{token}', [UserController::class, 'create'])->name('users.create');

Route::resource('users', UserController::class)->only(['store', 'update', 'destroy']);

Route::singleton('profile', ProfileController::class)->only('edit');

Route::resource('categories', CategoryController::class)->only(['show']);

Route::resource('posts', PostController::class)->only(['create','edit','destroy'])->middleware('auth');

Route::resource('user.posts', PostController::class)->only('show');

// Route::controller(ChangeEmailController::class)->group(function () {
//     Route::get('/users/{username}/edit-email', 'index')->name('changeEmail.index');
//     Route::post('/users/edit-email/send-code', 'sendCode')->name('changeEmail.sendCode');
//     Route::get('/users/{username}/edit-email/code-form', 'codeForm')->name('changeEmail.codeForm');
//     Route::get('/users/edit-email/change', 'change')->name('changeEmail.change');
// });

Route::resource('favorites',FavoriteController::class)->only(['index','destroy'])->middleware('auth');

// Route::resource('settlements',Settlement::class)->middleware('auth');

Route::resource('security-privacy',SecurityPrivacyController::class)->only('index')->middleware('auth');

Route::get('{username}', [ProfileController::class, 'show'])->name('profile.show');