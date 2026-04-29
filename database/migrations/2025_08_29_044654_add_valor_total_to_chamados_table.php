<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('chamados', function (Blueprint $table) {
            // Adiciona a coluna para o valor total, que pode ser nula.
            $table->decimal('valor_total', 10, 2)->nullable()->after('concluido');
        });
    }

    public function down(): void
    {
        Schema::table('chamados', function (Blueprint $table) {
            $table->dropColumn('valor_total');
        });
    }
};
