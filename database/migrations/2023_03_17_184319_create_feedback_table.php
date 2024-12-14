<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->text('subject')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('name')->nullable();
            $table->text('message')->nullable();
            $table->text('notes')->nullable();
            $table
                ->boolean('status')
                ->default(0)
                ->nullable();
            $table
                ->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('feedback');
    }
}
