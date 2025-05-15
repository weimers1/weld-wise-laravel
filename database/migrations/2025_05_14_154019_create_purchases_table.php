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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('tier'); // 1 or 2: tier 1 is single purchase, tier 2 is recurring
            $table->string('payment_type'); // tier 1 is one_time, tier 2 is recurring
            $table->string('paypal_identifier')->nullable(); // paypal_order_id (tier 1) or paypal_subscription_id (tier 2)
            $table->string('paypal_reference')->nullable(); // paypal_transaction_id (tier 1) or paypal_plan_id (tier 2)
            $table->string('status')->default('pending'); // pending, active, cancelled, suspended
            $table->decimal('amount', 8, 2)->nullable(); // track the amount paid at the time of purchase for auditing
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
