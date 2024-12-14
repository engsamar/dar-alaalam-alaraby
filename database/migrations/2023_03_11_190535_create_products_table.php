<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('active')->default(0)->nullable();
            $table->integer('position')->default(0)->nullable();
            $table->string('sku')->default(0)->nullable();
            $table->float('price')->default(0)->nullable();
            $table->float('discount')->default(0)->nullable();
            $table->float('weight')->nullable(); //default
            $table->integer('no_views')->nullable(); //default
            $table->boolean('in_new')->default(0)->nullable();
            $table->boolean('in_top_selling')->default(0)->nullable();
            $table->date('offer_expired_at')->nullable();
            $table->boolean('in_special_offer')->default(0)->nullable();
            $table
                ->foreignId('brand_id')
                ->nullable()
                ->constrained()
                ->on('brands')
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
                ->foreignId('category_id')
                ->nullable()
                ->constrained()
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table
                ->foreignId('sub_category_id')
                ->nullable()
                ->constrained()
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreignId('author_id')
                ->nullable()
                ->constrained()
                ->on('authors')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table
                ->foreignId('publisher_id')
                ->nullable()
                ->constrained()
                ->on('publishers')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->string('isbn')->nullable()->unique(); // ISBN number
            $table->year('publication_year')->nullable(); // Year of publication
            $table->integer('page_count')->nullable(); // Number of pages
            $table->string('language')->nullable(); // Language of the book
            $table->string('book_type')->nullable(); // Book type (e.g., paperback, hardcover, etc.)
            $table->decimal('weight', 8, 2)->nullable(); // Weight of the book, in kilograms
            $table->text('dimensions')->nullable(); // Dimensions of the book (e.g., "8 x 5 x 1 inches")
            $table->text('extra_info')->nullable(); // Additional information (e.g., series name, edition, etc.)

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
