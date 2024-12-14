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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();

            $table->float('vat')->nullable();
            $table->float('vat_value')->nullable();
            $table->integer('shipping_method')->nullable();

            $table->float('shipping_cost')->nullable();

            $table->float('discount')->nullable();
            $table->float('total_discount')->nullable();
            $table->float('coupon_discount')->nullable();
            $table->float('total_price')->nullable();

            $table
                ->foreignId('status_id')
                ->nullable()
                ->constrained()
                ->on('statuses')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('payment_status')->nullable();
            $table->integer('payment_method')->nullable();

            $table->string('reference_number')->nullable();

            $table->text('address_detail')->nullable();
            $table->text('latitude')->nullable();
            $table->text('longitude')->nullable();

            $table->text('comments')->nullable();
            $table->text('notes')->nullable();
            $table->string('coupon_code')->nullable();

            $table->float(column: 'delivery_cost')->default(0)->nullable();
            $table->uuid('order_uuid');
            $table->string('transaction_id')->nullable();
            $table->string('transaction_type')->nullable();
            $table->string('transaction_message')->nullable();
            $table->string('transaction_status')->nullable();
            $table->text('address')->nullable();

            $table->string('transaction_link')->nullable();
            $table
                ->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table
                ->foreignId('coupon_id')
                ->nullable()
                ->constrained()
                ->on('coupons')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table
                ->foreignId('address_id')
                ->nullable()
                ->constrained()
                ->on('addresses')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table
                ->foreignId('store_id')
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
        Schema::dropIfExists('orders');
    }
};
