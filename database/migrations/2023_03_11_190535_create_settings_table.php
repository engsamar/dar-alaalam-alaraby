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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->string('email')->nullable();
            $table->longText('about')->nullable();
            $table->longText('address')->nullable();
            $table->longText('footer')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsApp')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youTube')->nullable();
            $table->string('linkedIn')->nullable();
            $table->string('instagram')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_white')->nullable();
            $table->string('background_image')->nullable();
            $table->string('app_version')->nullable();
            $table->string('api_version')->nullable();
            $table->string('googlePlay')->nullable();
            $table->string('appStore')->nullable();
            $table->longText('terms_condition')->nullable();
            $table->longText('copyrights')->nullable();
            $table->longText('return_description')->nullable();
            $table->longText('privacy_description')->nullable();
            $table->float('vat')->default(9)->nullable();
            $table->string('logo_footer')->nullable();
            $table->string('breadcrumb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
