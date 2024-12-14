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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity')->nullable();
            $table->float('weight')->nullable();
            $table->float('price')->nullable();
            $table->float('discount')->nullable();

            $table->date('production_date')->nullable();
            $table->date('expiry_date')->nullable();

            $table
                ->foreignId('product_id')
                ->nullable()
                ->constrained()
                ->on('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table
                ->foreignId('supplier_id')
                ->nullable()
                ->constrained()
                ->on('suppliers')
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
        Schema::dropIfExists('stocks');
    }
};
