<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profil_user_changes', function (Blueprint $table) {
            // Vérifier et ajouter chaque colonne si elle n'existe pas
            if (!Schema::hasColumn('profil_user_changes', 'first_name')) {
                $table->string('first_name')->nullable();
            }
            if (!Schema::hasColumn('profil_user_changes', 'last_name')) {
                $table->string('last_name')->nullable();
            }
            if (!Schema::hasColumn('profil_user_changes', 'phone')) {
                $table->string('phone')->nullable();
            }
            if (!Schema::hasColumn('profil_user_changes', 'email')) {
                $table->string('email')->nullable();
            }
            if (!Schema::hasColumn('profil_user_changes', 'old_email')) {
                $table->string('old_email')->nullable();
            }
            if (!Schema::hasColumn('profil_user_changes', 'avatar')) {
                $table->string('avatar')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('profil_user_changes', function (Blueprint $table) {
            $table->dropColumn([
                'first_name', 'last_name', 'phone', 'email', 'old_email', 'avatar'
            ]);
        });
    }
};
