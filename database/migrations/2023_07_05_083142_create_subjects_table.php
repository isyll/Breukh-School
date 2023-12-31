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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_group_id')
                ->nullable()
                ->constrained(table: 'subject_groups')
                ->nullOnDelete()
                ->nullOnUpdate();
            $table->string("name")->unique();
            $table->string("code")->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
