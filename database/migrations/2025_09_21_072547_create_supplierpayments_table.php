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
        Schema::create('supplierpayments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("supplier_id")->constrained("suppliers")->onDelete("cascade");
              $table->foreignId("purchase_id")->constrained("purchases")->onDelete("cascade");
          
          $table->decimal("paid");
            $table->date("date");
    });
}

    public function down(): void
    {
        Schema::dropIfExists('supplierpayments');
    }
};
