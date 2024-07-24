<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('external_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('country_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('city_id')->nullable()->constrained()->nullOnDelete();
            $table->text('name');
            $table->text('english_name')->nullable();
            $table->text('slug');
            $table->text('description')->nullable();
            $table->text('image_path')->nullable();
            $table->date('deadline')->nullable()->index();
            $table->text('url');
            $table->string('work_type')->nullable()->index();
            $table->string('job_type')->nullable()->index();
            $table->string('price')->nullable()->index();
            $table->json('props')->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE external_jobs ADD INDEX external_jobs_name_index(`name`(255))');
        DB::statement('ALTER TABLE external_jobs ADD INDEX external_jobs_english_name_index(`english_name`(255))');
        DB::statement('ALTER TABLE external_jobs ADD INDEX external_jobs_description_index(`description`(255))');
    }

    public function down(): void
    {
        Schema::dropIfExists('external_jobs');
    }
};
