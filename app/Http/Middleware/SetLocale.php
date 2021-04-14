<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = config('app.fallback_locale');

        if (auth()->check()){
            $locale = auth()->user()->locale ? auth()->user()->locale : config('app.fallback_locale');
        } elseif (Cookie::has('locale')){
            $locale = Cookie::get('locale');
        }
        app()->setLocale($locale);

        return $next($request);
    }
}
