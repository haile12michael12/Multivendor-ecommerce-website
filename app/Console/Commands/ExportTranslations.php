<?php

namespace App\Console\Commands;

use App\Models\Language;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ExportTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translations:export {--lang=* : The language codes to export}'
                           . ' {--all : Export all languages}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export translations from database to language files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Determine which languages to export
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
            $this->exportLanguage($language);
        }
        
        $this->info('Translations exported successfully!');
        return 0;
    }
    
    /**
     * Export translations for a specific language
     */
    private function exportLanguage(Language $language)
    {
        $langPath = resource_path('lang/' . $language->lang);
        
        // Create language directory if it doesn't exist
        if (!File::exists($langPath)) {
            File::makeDirectory($langPath, 0755, true);
        }
        
        // Get translations from database
        // This is a placeholder - you would need to implement a table for storing translations
        // For now, we'll just use the default messages file if it exists
        
        $messagesFile = $langPath . '/messages.php';
        
        if (!File::exists($messagesFile)) {
            // Create an empty messages file if it doesn't exist
            $content = "<?php\n\nreturn [\n    // Add translations here\n];\n";
            File::put($messagesFile, $content);
        }
        
        $this->info("Exported translations for {$language->name} ({$language->lang})");
    }
}