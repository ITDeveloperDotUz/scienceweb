<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;


class SettingsController extends Controller
{
    public function setLocale(Request $request, $locale)
    {
        if(auth()->check()){
            auth()->user()->update(['locale' => $locale]);
        }
        return back()->withCookie(cookie()->forever('locale', $locale));
    }
}
