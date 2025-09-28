<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function switch(Request $request)
    {
        // Get all active languages
        $activeLanguages = Language::where('status', 1)->pluck('lang')->toArray();
        
        $validated = $request->validate([
            'locale' => 'required|in:' . implode(',', $activeLanguages),
        ]);

        // Store the locale in session
        Session::put('locale', $validated['locale']);
        
        // Set the application locale
        App::setLocale($validated['locale']);
        
        return Redirect::back();
    }
    
    /**
     * Get all active languages
     */
    public function getActiveLanguages()
    {
        return Language::where('status', 1)->get();
    }
}