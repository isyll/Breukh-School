<?php

use App\Models\Classe;
use App\Models\Subject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('classe_subject', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classe_id')->constrained(table: 'classes');
            $table->foreignId('subject_id')->constrained(table: 'subjects');
            $table->foreignId('school_year_id')->constrained(table: 'school_years');
            $table->integer("max_note")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classe_subject');
    }
};