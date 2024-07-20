<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettlementController extends Controller
{
    public function index(){
        $user = Auth::user();
        // dd($user->profile->social_media->first());
        return view('sections.profile.index',[
            'profile' => $user->profile,
            'section' => 'settlements-history'
        ]);
    }
}
