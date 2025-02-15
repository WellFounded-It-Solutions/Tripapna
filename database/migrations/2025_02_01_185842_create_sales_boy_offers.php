<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sales_boy_offers', function (Blueprint $table) {
            $table->id();
            $table->string('offer');
            $table->decimal('commission', 8, 2);
            $table->boolean('automatic_credit_commission')->default(false);
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes(); // For deleted offers
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_boy_offers');
    }
};
