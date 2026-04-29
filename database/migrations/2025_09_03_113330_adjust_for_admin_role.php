<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('tecnicos', 'users');

        // Adiciona a coluna 'role' na nova tabela users
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('tecnico')->after('password');
        });

        Schema::table('chamados', function (Blueprint $table) {
            $table->renameColumn('tecnico_id', 'user_id');
        });
    }

    public function down(): void
    {
        Schema::table('chamados', function (Blueprint $table) {
            $table->renameColumn('user_id', 'tecnico_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });

        Schema::rename('users', 'tecnicos');
    }
};

