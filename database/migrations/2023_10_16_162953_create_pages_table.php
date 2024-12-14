<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(0)->nullable();
            $table->integer('position')->default(0)->nullable();//rank
            $table->string('image')->nullable();
            $table->longText('title')->nullable();
            $table->longText('sub_title')->nullable();
            $table->longText('description')->nullable();
            $table->string('link')->nullable();
            $table->string('icon')->nullable();
            $table->string('slug')->default('01')->nullable();
            $table->integer('type')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
