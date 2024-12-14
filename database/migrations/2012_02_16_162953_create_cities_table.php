<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(0)->nullable();
            $table->integer('position')->default(0)->nullable(); //rank
            $table->string('image')->nullable();
            $table->string('code')->nullable();
            $table
                ->foreignId('country_id')
                ->nullable()
                ->constrained()
                ->on('countries')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreignId('city_id')
                ->nullable()
                ->constrained()
                ->on('cities')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->longText('title')->nullable();
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
        Schema::dropIfExists('cities');
    }
}
