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
        // Schema::create('classe_note_type', function (Blueprint $table) {
            // $table->id();
            // $table->foreignId('classe_id')
            //     ->constrained(table: 'classes')
            //     ->cascadeOnDelete()
            //     ->cascadeOnUpdate();
            // $table->foreignId('note_type_id')
            //     ->constrained(table: 'note_types')
            //     ->nullOnDelete()
            //     ->cascadeOnUpdate();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('classe_note_type');
    }
};
