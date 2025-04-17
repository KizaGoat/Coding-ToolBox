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
        // Remove password column
        Schema::table('profil_user_changes', function (Blueprint $table) {
            $table->dropColumn('password');
        });
    }

    public function down(): void
    {
        // Add password column
        Schema::table('profil_user_changes', function (Blueprint $table) {
            $table->string('password')->nullable();
        });
    }

};
