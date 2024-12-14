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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(0)->nullable();
            $table->integer('position')->default(0)->nullable();//rank
            $table->string('image')->nullable();
            $table->longText('title')->nullable();
            $table->longText('writer')->nullable();
            $table->date('date')->nullable();
            $table->longText('sub_title')->nullable();
            $table->longText('description')->nullable();
            $table->longText('keywords')->nullable();
            $table->longText('tags')->nullable();
            $table->string('link')->nullable();
            $table->string('slug')->default('01')->nullable();
            $table
                ->foreignId('catalogue_id')
                ->nullable()
                ->constrained()
                ->on('catalogues')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('articles');
    }
};
