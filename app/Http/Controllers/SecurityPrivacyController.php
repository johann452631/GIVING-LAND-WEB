<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecurityPrivacyController extends Controller
{
    //
    public function index()
    {
        return view('sections.security-privacy.index');
    }
}
