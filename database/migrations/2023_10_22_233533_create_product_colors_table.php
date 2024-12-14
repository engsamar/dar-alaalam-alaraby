<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_colors', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->integer('quantity')->nullable();
            $table->boolean('default')->default(0)->nullable();
            $table->string('color_code')->nullable();
            $table->float('price')->nullable();
            $table->float('discount')->nullable();
            $table
                ->foreignId('size_id')
                ->nullable()
                ->constrained()
                ->on('product_sizes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreignId('stock_id')
                ->nullable()
                ->constrained()
                ->on('stocks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreignId('product_id')
                ->nullable()
                ->constrained()
                ->on('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table
                ->foreignId('color_id')
                ->nullable()
                ->constrained()
                ->on('colors')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_colors');
    }
};
