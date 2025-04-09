<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('student_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users'); // L'étudiant, ici on suppose que tu as une table 'users' pour les étudiants
            $table->foreignId('tag_id')->constrained('tags'); // L'étiquette
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_tag');
    }
};
