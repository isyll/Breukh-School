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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_id')
                ->constrained(table: 'enrollments');
            $table->foreignId('classe_subject_id')
                ->constrained(table: 'classe_subject')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('evaluation_id')
                ->constrained(table: 'evaluations');
            $table->float('value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};