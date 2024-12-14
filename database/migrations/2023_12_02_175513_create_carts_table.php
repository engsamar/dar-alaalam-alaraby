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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('product_id')
                ->nullable()
                ->constrained()
                ->on('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table
                ->foreignId('store_id')
                ->nullable()
                ->constrained()
                ->on('stores')
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
                ->foreignId('size_id')
                ->nullable()
                ->constrained()
                ->on('product_sizes')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table
                ->foreignId('color_id')
                ->nullable()
                ->constrained()
                ->on('product_colors')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('quantity')->nullable();
            $table->string('device')->nullable();
            $table->boolean('is_guest')->nullable();//guest

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
