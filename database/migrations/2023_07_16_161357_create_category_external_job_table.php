<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('category_external_job', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('external_job_id')->constrained('external_jobs')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_external_job');
    }
};
