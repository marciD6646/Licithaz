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
        Schema::create('products', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->text('description');
            $table->text("extended_description");
            $table->string('image_url')->nullable();
            $table->integer('starter_bid')->default(1000);
            $table->date('bid_start_date');
            $table->date('bid_end_date');

            $table->enum('category', [
                'Electronics',
                'Books',
                'Clothing',
                'House',
                'Sports',
                'Vehicles',
                'Jewelry'
            ])->default('Electronics');

            $table->string('status')->default('active');
            $table->foreignId('winner_id')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();
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
