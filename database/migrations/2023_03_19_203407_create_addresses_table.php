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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('address')->nullable();
            $table->text('notes')->nullable();
            $table->string('mobile')->nullable();
            $table
                ->foreignId('type_id')
                ->nullable()
                ->constrained()
                ->on('address_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->boolean('is_main')->nullable();
            $table
                ->foreignId('city_id')
                ->nullable()
                ->constrained()
                ->on('cities')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table
                ->foreignId('area_id')
                ->nullable()
                ->constrained()
                ->on('cities')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
