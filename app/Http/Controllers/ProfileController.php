<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Profile;
use App\Models\User;
use App\MyOwn\classes\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show($username)
    {
        if (!User::where('username', $username)->exists()) {
            return to_route('home');
        }
        $profile = User::where('username', $username)->first()->profile;
        $posts = $profile->user->posts->sortByDesc('created_at');
        // $posts = $profile->user->posts;
        // dd($posts);
        return view('sections.profile.show', compact('profile','posts'));
    }

    public function edit()
    {
        $username = Auth::user()->username;
        return view('sections.profile.edit', compact('username'));
    }

    // public function goToSection($username, $section)
    // {
    //     switch ($section) {
    //         case 'favorites':
    //             # code...
    //             break;
    //         case 'settlements-history':
    //             # code...
    //             break;
    //         case 'security-privacy':
    //             # code...
    //             break;

    //         default:
    //             return to_route('home');
    //             break;
    //     }

    //     $profile = Auth::user()->profile;
    //     return view('sections.profile.index', compact('section', 'profile'));
    // }
}
