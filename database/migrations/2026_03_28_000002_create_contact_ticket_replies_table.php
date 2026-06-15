<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contact_ticket_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_ticket_id')->constrained('contact_tickets')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('message');
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();

            $table->index(['contact_ticket_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_ticket_replies');
    }
};
