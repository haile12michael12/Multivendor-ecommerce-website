<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('languages', function (Blueprint $table) {
            $table->string('country_code', 2)->nullable()->after('lang');
        });

        // Set default country codes for existing languages
        DB::table('languages')->where('lang', 'en')->update(['country_code' => 'gb']);
        DB::table('languages')->where('lang', 'am')->update(['country_code' => 'et']);
    }

    public function down(): void
    {
        Schema::table('languages', function (Blueprint $table) {
            $table->dropColumn('country_code');
        });
    }
};