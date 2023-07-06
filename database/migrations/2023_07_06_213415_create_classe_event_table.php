<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('classe_event', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classe_id')
                ->constrained('classes')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('event_id')
                ->constrained('events')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->unique(['classe_id', 'event_id'], 'classe_event_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classe_event');
    }
};