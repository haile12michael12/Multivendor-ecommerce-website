<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::all();
        return view('admin.language.index', compact('languages'));
    }

    public function create()
    {
        return view('admin.language.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lang' => 'required|string|max:10|unique:languages,lang',
            'country_code' => 'required|string|size:2',
            'default' => 'required|boolean',
            'status' => 'required|boolean',
        ]);

        // If this is set as default, unset all other defaults
        if ($request->default) {
            Language::where('default', 1)->update(['default' => 0]);
        }

        // Create the language
        Language::create([
            'name' => $request->name,
            'lang' => $request->lang,
            'country_code' => strtolower($request->country_code),
            'slug' => Str::slug($request->name),
            'default' => $request->default,
            'status' => $request->status,
        ]);

        // Create language file if it doesn't exist
        $langPath = resource_path('lang/' . $request->lang);
        if (!File::exists($langPath)) {
            File::makeDirectory($langPath, 0755, true);
            
            // Copy messages.php from English if it exists
            $enMessagesPath = resource_path('lang/en/messages.php');
            if (File::exists($enMessagesPath)) {
                File::copy($enMessagesPath, $langPath . '/messages.php');
            } else {
                // Create an empty messages file
                File::put($langPath . '/messages.php', "<?php\n\nreturn [\n    //\n];\n");
            }
        }

        return redirect()->route('admin.languages.index')->with('success', 'Language created successfully');
    }

    public function edit(Language $language)
    {
        return view('admin.language.edit', compact('language'));
    }

    public function update(Request $request, Language $language)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'lang' => 'required|string|max:10|unique:languages,lang,' . $language->id,
            'country_code' => 'required|string|size:2',
            'default' => 'required|boolean',
            'status' => 'required|boolean',
        ]);

        // If this is set as default, unset all other defaults
        if ($request->default) {
            Language::where('default', 1)->update(['default' => 0]);
        }

        // Update the language
        $language->update([
            'name' => $request->name,
            'lang' => $request->lang,
            'country_code' => strtolower($request->country_code),
            'slug' => Str::slug($request->name),
            'default' => $request->default,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.languages.index')->with('success', 'Language updated successfully');
    }

    public function destroy(Language $language)
    {
        // Don't allow deletion of default language
        if ($language->default) {
            return back()->with('error', 'Cannot delete the default language');
        }

        $language->delete();

        return back()->with('success', 'Language deleted successfully');
    }
    
    /**
     * Show the translations for a language.
     */
    public function translations(Language $language)
    {
        $messagesFile = resource_path('lang/' . $language->lang . '/messages.php');
        $translations = [];

        if (File::exists($messagesFile)) {
            $translations = require $messagesFile;
        }

        return view('admin.language.translations', compact('language', 'translations'));
    }

    /**
     * Update translations for a language.
     */
    public function updateTranslations(Request $request, Language $language)
    {
        $translations = $request->input('translations', []);
        $messagesFile = resource_path('lang/' . $language->lang . '/messages.php');

        // Format translations array for PHP file
        $content = "<?php\n\nreturn [\n";
        foreach ($translations as $key => $value) {
            $escapedValue = str_replace("'", "\\'", $value);
            $content .= "    '{$key}' => '{$escapedValue}',\n";
        }
        $content .= "];\n";

        // Write to file
        File::put($messagesFile, $content);

        return redirect()->route('admin.languages.translations', $language->id)
            ->with('success', 'Translations updated successfully');
    }
}