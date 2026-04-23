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
        Schema::create('purchaseitems', function (Blueprint $table) {
            $table->id();
            $table->foreignId("purchase_id")->constrained("purchases")->onDelete("cascade");
            $table->foreignId("product_id")->constrained("products")->onDelete("cascade");
            $table->integer("quantity");
            $table->decimal("price");
            $table->decimal("subtotal");
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchaseitems');
    }
};
