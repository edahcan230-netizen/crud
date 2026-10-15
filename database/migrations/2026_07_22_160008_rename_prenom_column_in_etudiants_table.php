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
        if (Schema::hasColumn('etudiants', 'Prénom') && ! Schema::hasColumn('etudiants', 'Prenom')) {
            Schema::table('etudiants', function (Blueprint $table) {
                $table->renameColumn('Prénom', 'Prenom');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('etudiants', 'Prenom') && ! Schema::hasColumn('etudiants', 'Prénom')) {
            Schema::table('etudiants', function (Blueprint $table) {
                $table->renameColumn('Prenom', 'Prénom');
            });
        }
    }
};