<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('cover_url')->nullable();
            $table->string('audio_url');
            $table->foreignId('season_id')->nullable()->constrained('seasons');
            $table->foreignUuid('podcast_id')->constrained('podcasts');
            $table->timestamps(); //
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('episodes');
    }
};
