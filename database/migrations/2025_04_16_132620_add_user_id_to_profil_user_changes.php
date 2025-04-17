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
        // add user_id foreign key with cascade delete
        Schema::table('profil_user_changes', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->after('id');
        });
    }

    public function down(): void
    {
        // drop user_id column
        Schema::table('profil_user_changes', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }

};
