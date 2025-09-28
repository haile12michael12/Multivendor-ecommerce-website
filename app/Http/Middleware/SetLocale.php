<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        } else {
            // Get default language from database
            $defaultLanguage = Language::where('default', 1)->where('status', 1)->first();
            
            if ($defaultLanguage) {
                App::setLocale($defaultLanguage->lang);
                Session::put('locale', $defaultLanguage->lang);
            }
        }
        
        return $next($request);
    }
}