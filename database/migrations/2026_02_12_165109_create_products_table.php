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
            $table->string('image_url');
            $table->integer('starter_bid')->default(1000)->round(-3);
            $table->date('bid_start_date')->default(now());
            $table->date('bid_end_date')->default(now()->addDays(7));
            $table->enum('category', [
                'Electronics',
                'Books',
                'Clothing',
                'House',
                'Sports',
                'Vehicles',
                'Jewelry'
            ])->default('Electronics');
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
