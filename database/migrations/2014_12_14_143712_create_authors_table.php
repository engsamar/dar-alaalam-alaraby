<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('image')->nullable();
            $table->string('logo')->nullable();
            $table->longText('address')->nullable();
            $table->boolean('active')->default(1);
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->integer('position')->default(0)->nullable(); // rank
            $table->integer('no_views')->nullable(); // default
            $table->enum('gender', ['male', 'female'])->nullable(); // default
            $table->date('birth_date')->nullable();

            $table->string('slug')->nullable();
            $table
                ->foreignId('nationality_id')
                ->nullable()
                ->constrained()
                ->on('countries')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreignId('country_id')
                ->nullable()
                ->constrained()
                ->on('countries')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreignId('category_id')
                ->nullable()
                ->constrained()
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
