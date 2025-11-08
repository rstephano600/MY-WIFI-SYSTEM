<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('subject')->nullable();
            $table->text('message');
            $table->enum('status', ['open','in_progress','closed'])->default('open');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('support_tickets');
    }
};
