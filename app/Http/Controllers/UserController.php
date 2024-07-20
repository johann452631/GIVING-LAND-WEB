<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Image;
use App\Models\Profile;
use App\Models\User;
use App\MyOwn\classes\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(EnsureTokenIsValid::class)->only('create');
        $this->middleware('guest')->only(['create','store']);
        // $this->middleware('auth')->only(['update','destroy']);
    }

    public function create(Request $request)
    {
        return view('sections.users.create')->with([
            'email' => $request->email,
            'email_verified_at' => now()
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        session()->forget('token');
        $request->merge(['password' => Hash::make($request->password)]);
        $user = User::create($request->except('_token'));
        $user->username = Utility::generateUsername($user->name);
        $user->save();
        $user->profile()->create()->image()->create(['url' => 'default.svg']);
        // $user->profile->image()->save(Image::create(['url' => 'default.svg']));
        Auth::login($user);
        $request->session()->regenerate();
        // Utility::sendAlert('success', 'Se registró y se inició sesión.');
        return to_route('home');
    }

    // public function update(UpdateUserRequest $request, $id)
    // {
    //     $user = User::find($id);
    //     Auth::login($user);
    //     Utility::sendAlert('exito', 'Se actualizaron los datos');
    //     return to_route('users.show', $user->username);
    // }

    public function destroy($id){
        User::destroy($id);
    }
}
