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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string("firstname");
            $table->string("lastname");
            $table->string("email")->unique();
            $table->dateTime("birthdate")->nullable();
            $table->string("birthplace")->nullable();
            $table->enum("gender", ['male', 'female'])->nullable();
            $table->enum("profile", ['internal', 'external']);
            $table->foreignId('parent_id')->constrained('parents');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');

    }
};
