<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('routers', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number')->unique();
            $table->string('model')->nullable();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null');
            $table->string('wifi_name')->default('TTCL-WIFI');
            $table->string('wifi_password')->default('12345678');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamp('registered_date')->useCurrent();
        });
    }

    public function down(): void {
        Schema::dropIfExists('routers');
    }
};
