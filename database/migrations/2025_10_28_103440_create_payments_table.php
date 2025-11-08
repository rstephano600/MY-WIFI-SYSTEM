<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('bundle_id')->constrained('bundles')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('remaining_data_gb', 10, 2)->default(0);
            $table->enum('status', ['active', 'expired', 'pending'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('subscriptions');
    }
};
