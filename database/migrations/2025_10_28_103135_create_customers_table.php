<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('full_name');
            $table->string('phone')->unique();
            $table->string('address')->nullable();
            $table->string('router_serial')->unique()->nullable();
            $table->string('location')->nullable();
            $table->timestamp('registration_date')->useCurrent();
        });
    }

    public function down(): void {
        Schema::dropIfExists('customers');
    }
};
