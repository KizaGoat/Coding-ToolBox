<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('profil_user_changes', function (Blueprint $table) {
            $table->string('old_email')->nullable(); // Ajoute la colonne 'old_email'
        });
    }

    public function down(): void
    {
        Schema::table('profil_user_changes', function (Blueprint $table) {
            $table->dropColumn('old_email'); // Retirer la colonne si besoin
        });
    }

};
