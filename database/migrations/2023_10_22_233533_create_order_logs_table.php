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
        Schema::create('order_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->nullable();
            $table->integer('old_status')->nullable();

            $table
                ->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table
                ->foreignId('status_id')
                ->nullable()
                ->constrained()
                ->on('statuses')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table
                ->foreignId('order_id')
                ->nullable()
                ->constrained()
                ->on('orders')
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
        Schema::dropIfExists('order_logs');
    }
};
