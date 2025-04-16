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
        // Ajouter une colonne password à la table profil_user_changes
        Schema::table('profil_user_changes', function (Blueprint $table) {
            $table->string('password')->nullable();  // Colonne password
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Supprimer la colonne password si la migration est annulée
        Schema::table('profil_user_changes', function (Blueprint $table) {
            $table->dropColumn('password');
        });
    }
};
