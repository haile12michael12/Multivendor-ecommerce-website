<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Helpers\TranslationHelper;

class TranslationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Register the @trans directive
        Blade::directive('trans', function ($expression) {
            return "<?php echo \App\Helpers\TranslationHelper::translate($expression); ?>";
        });
    }
}