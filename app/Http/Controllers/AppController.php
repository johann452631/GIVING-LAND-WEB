<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\MyOwn\classes\Utility;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function home(){
        // $posts = Post::all()->sortByDesc('created_at');
        $categories = Category::all();
        return view('home',compact('categories'));
    }

    public static function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        Utility::sendAlert('danger', 'Se cerró sesión.');
        return to_route('home');
    }
}
