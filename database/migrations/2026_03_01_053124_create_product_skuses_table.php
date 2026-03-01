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
        Schema::create('product_skuses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor('product_id')->constrained()->cascadeOnDelete();
            // take color and size from product attributes
            $table->foreignIdFor('color_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor('size_id')->constrained()->cascadeOnDelete();
            $table->string('sku')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('stock')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_skuses');
    }
};
