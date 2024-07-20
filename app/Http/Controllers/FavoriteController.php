<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()->favorites;
        return view('sections.favorites.index', compact('favorites'));
    }

    public function destroy($id)
    {
        $user = auth()->user();
        if ($user->favorites()->where('post_id', $id)) {
            auth()->user()->favorites()->detach($id);
        }
        return to_route('favorites.index');
    }
}
