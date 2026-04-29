<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chamados', function (Blueprint $table) {
            $table->id();
            $table->text('descricao');
            $table->foreignId('tipo_id')->constrained('tipos_chamado');
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->foreignId('tecnico_id')->constrained('tecnicos');
            $table->boolean('concluido')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chamados');
    }
};
