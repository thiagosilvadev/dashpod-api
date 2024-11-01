<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('episode_transcriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('text');
            $table->foreignUuid('episode_id');
            $table->float('start');
            $table->float('end');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('episode_transcriptions');
    }
};
