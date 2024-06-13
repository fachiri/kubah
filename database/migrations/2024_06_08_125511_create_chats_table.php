<?php

use App\Constants\ChatStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid');
            $table->string('subject');
            $table->tinyInteger('is_anonim')->default(0);
            $table->string('status', 24)->default(ChatStatus::OPEN);
            $table->foreignId('common_user_id')->constrained('common_users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
