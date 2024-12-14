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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(0)->nullable();
            $table->integer('position')->default(0)->nullable();
            $table->string('image')->nullable();
            $table->longText('title')->nullable();
            $table->date('date')->nullable();
            $table->longText('sub_title')->nullable();
            $table->longText('description')->nullable();

            $table->string('slug')->default('01')->nullable();
            $table
                ->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->on('users')
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
        Schema::dropIfExists('testimonials');
    }
};
