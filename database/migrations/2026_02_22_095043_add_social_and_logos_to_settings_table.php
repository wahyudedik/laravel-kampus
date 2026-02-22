<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('logo_1')->nullable();
            $table->string('logo_2')->nullable();
            $table->string('logo_3')->nullable();
            $table->string('logo_4')->nullable();
            $table->string('ig_1')->nullable();
            $table->string('link_ig_1')->nullable();
            $table->string('ig_2')->nullable();
            $table->string('link_ig_2')->nullable();
            $table->string('logo_website')->nullable();
            $table->string('link_website')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'logo_1', 'logo_2', 'logo_3', 'logo_4',
                'ig_1', 'link_ig_1',
                'ig_2', 'link_ig_2',
                'logo_website', 'link_website'
            ]);
        });
    }
};
