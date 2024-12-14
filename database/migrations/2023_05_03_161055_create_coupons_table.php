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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table
                ->integer('type')
                ->default(0)
                ->nullable();
            $table->float('discount')->nullable();
            $table
                ->boolean('active')
                ->default(0)
                ->nullable();
            $table
                ->integer('position')
                ->default(0)
                ->nullable();
            $table
                ->integer('maximum_usage')
                ->default(0)
                ->nullable();
            $table
                ->string('code')
                ->unique()
                ->nullable();
            $table->date('started_at')->nullable();
            $table->date('expired_at')->nullable();

            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table
                ->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table
                ->integer('notify_type')
                ->default(0) //send notification only
                ->nullable();

            $table
                ->integer('notify_days')
                ->default(0) //send notification only
                ->nullable();
            $table
                ->integer('condition')
                ->default(0)
                ->nullable(); //0-1-2
            $table->float('max_value_discount')->nullable();
            $table->float('total_order_amount')->nullable();

            $table
                ->integer('coupon_type')
                ->nullable()
                ->default(0); //1 register 0 normal coupon , birth date 3
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
