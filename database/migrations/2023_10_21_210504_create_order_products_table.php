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
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();

            $table->float('unit_price')->default(0)->nullable();
            $table->float('price')->default(0)->nullable();
            $table->float('total_price')->default(0)->nullable();
            $table->float('discount_value')->default(0)->nullable();
            $table->float('discount')->default(0)->nullable();
            $table->integer('quantity')->default(0)->nullable();
            $table
                ->foreignId('size_id')
                ->nullable()
                ->constrained()
                ->on('sizes')
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
                ->foreignId('color_id')
                ->nullable()
                ->constrained()
                ->on('colors')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreignId('order_id')
                ->nullable()
                ->constrained()
                ->on('orders')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table
                ->foreignId('product_id')
                ->nullable()
                ->constrained()
                ->on('products')
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
        Schema::dropIfExists('order_products');
    }
};
