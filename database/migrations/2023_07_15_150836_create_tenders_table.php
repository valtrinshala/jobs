<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tenders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('country_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('city_id')->nullable()->constrained()->nullOnDelete();
            $table->text('name');
            $table->text('slug');
            $table->text('description')->nullable();
            $table->text('image_path')->nullable();
            $table->date('deadline')->nullable();
            $table->text('url');
            $table->string('price')->nullable()->index();
            $table->json('props')->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE tenders ADD INDEX tenders_name_index(`name`(255))');
        DB::statement('ALTER TABLE tenders ADD INDEX tenders_description_index(`description`(255))');
    }

    public function down(): void
    {
        Schema::dropIfExists('tenders');
    }
};
