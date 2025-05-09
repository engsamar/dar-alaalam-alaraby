<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(0)->nullable();
            $table->integer('position')->default(0)->nullable();

            $table->integer('type')->default(0)->nullable();
            $table->string('slug')->nullable();
            $table
                ->foreignId('category_id')
                ->nullable()
                ->constrained()
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->longText('title')->nullable();
            $table->string('image')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
