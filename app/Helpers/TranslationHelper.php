<?php

namespace App\Helpers;

use App\Models\Language;
use Illuminate\Support\Facades\Lang;

class TranslationHelper
{
    /**
     * Translate a string using the messages file
     *
     * @param string $key
     * @param array $replace
     * @param string|null $locale
     * @return string
     */
    public static function translate($key, $replace = [], $locale = null)
    {
        if (Lang::has('messages.' . $key, $locale)) {
            return __('messages.' . $key, $replace, $locale);
        }
        
        return $key;
    }

    /**
     * Get all active languages
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getActiveLanguages()
    {
        return Language::where('status', 1)->get();
    }

    /**
     * Get default language
     *
     * @return \App\Models\Language|null
     */
    public static function getDefaultLanguage()
    {
        return Language::where('default', 1)->where('status', 1)->first();
    }
}