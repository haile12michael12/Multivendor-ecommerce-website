<?php

namespace App\Console\Commands;

use App\Models\Language;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateLanguageFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'language:generate {lang? : The language code}'
                           . ' {--all : Generate files for all languages}'
                           . ' {--force : Force overwrite existing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate language files for specified language';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $langPath = resource_path('lang');
        
        // Check if we should process all languages
        if ($this->option('all')) {
            $languages = Language::where('status', 1)->get();
            
            foreach ($languages as $language) {
                $this->generateLanguageFiles($language->lang, $langPath);
            }
            
            $this->info('All language files generated successfully!');
            return;
        }
        
        // Process a single language
        $lang = $this->argument('lang');
        
        if (!$lang) {
            $this->error('Please specify a language code or use --all option.');
            return;
        }
        
        $language = Language::where('lang', $lang)->first();
        
        if (!$language) {
            $this->error("Language with code '{$lang}' not found in the database.");
            return;
        }
        
        $this->generateLanguageFiles($lang, $langPath);
        $this->info("Language files for '{$lang}' generated successfully!");
    }
    
    /**
     * Generate language files for a specific language
     */
    private function generateLanguageFiles($lang, $langPath)
    {
        // Create language directory if it doesn't exist
        if (!File::exists($langPath . '/' . $lang)) {
            File::makeDirectory($langPath . '/' . $lang, 0755, true);
            $this->line("Created directory for '{$lang}'");
        }
        
        // Check if messages.php exists
        $messagesFile = $langPath . '/' . $lang . '/messages.php';
        
        if (File::exists($messagesFile) && !$this->option('force')) {
            $this->line("Messages file for '{$lang}' already exists. Use --force to overwrite.");
            return;
        }
        
        // If English exists, use it as a template
        $templateFile = $langPath . '/en/messages.php';
        
        if (File::exists($templateFile)) {
            File::copy($templateFile, $messagesFile);
            $this->line("Created messages file for '{$lang}' from English template.");
        } else {
            // Create an empty messages file
            $content = "<?php\n\nreturn [\n    // Add translations here\n];\n";
            File::put($messagesFile, $content);
            $this->line("Created empty messages file for '{$lang}'.");
        }
    }
}