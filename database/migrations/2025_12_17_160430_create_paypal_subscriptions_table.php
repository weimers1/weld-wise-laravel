<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paypal_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('paypal_subscription_id');
            $table->string('paypal_plan_id');
            $table->enum('subscription_status', ['none', 'active', 'canceled', 'expired', 'past_due', 'suspended'])->default('none');
            $table->timestamp('current_period_end')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['user_id', 'subscription_status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paypal_subscriptions');
    }
};