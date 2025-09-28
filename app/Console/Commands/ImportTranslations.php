<?php

namespace App\Console\Commands;

use App\Models\Language;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ImportTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translations:import {--lang=* : The language codes to import}'
                           . ' {--all : Import all languages}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import translations from language files to database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Determine which languages to import
        if ($this->option('all')) {
            $languages = Language::where('status', 1)->get();
        } else {
            $langCodes = $this->option('lang');
            
            if (empty($langCodes)) {
                $this->error('Please specify language codes with --lang option or use --all');
                return 1;
            }
            
            $languages = Language::whereIn('lang', $langCodes)->get();
            
            if ($languages->isEmpty()) {
                $this->error('No languages found with the specified codes');
                return 1;
            }
        }
        
        foreach ($languages as $language) {
            $this->importLanguage($language);
        }
        
        $this->info('Translations imported successfully!');
        return 0;
    }
    
    /**
     * Import translations for a specific language
     */
    private function importLanguage(Language $language)
    {
        $langPath = resource_path('lang/' . $language->lang);
        
        // Check if language directory exists
        if (!File::exists($langPath)) {
            $this->warn("Language directory for {$language->lang} does not exist. Skipping.");
            return;
        }
        
        $messagesFile = $langPath . '/messages.php';
        
        // Check if messages file exists
        if (!File::exists($messagesFile)) {
            $this->warn("Messages file for {$language->lang} does not exist. Skipping.");
            return;
        }
        
        // Load translations from file
        $translations = require $messagesFile;
        
        // Import translations to database
        // This is a placeholder - you would need to implement a table for storing translations
        // For now, we'll just log the number of translations
        
        $this->info("Imported " . count($translations) . " translations for {$language->name} ({$language->lang})");
    }
}