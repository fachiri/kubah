<?php

use App\Constants\ComplaintStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid')->unique();
            $table->string('reporter_role');
            $table->string('ktp');
            $table->string('category');
            $table->string('status')->default(ComplaintStatus::PENDING);
            $table->text('description');
            $table->string('location');
            $table->date('incident_date');
            $table->time('incident_time');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
