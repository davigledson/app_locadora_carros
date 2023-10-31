<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

//LOCACOES
// Renomear a classe para CreateLocacoesTable
// Renomear a tabela para locacoes (ajustar o model)
public function up()
{
    Schema::create('locacoes', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('cliente_id');
        $table->unsignedBigInteger('carro_id');
        $table->dateTime('data_inicio_periodo');
        $table->dateTime('data_final_previsto_periodo');
        $table->dateTime('data_final_realizado_periodo');
        $table->float('valor_diaria', 8,2);
        $table->integer('km_inicial');
        $table->integer('km_final');
        $table->timestamps();

        //foreign key (constraints)
        $table->foreign('cliente_id')->references('id')->on('clientes');
        $table->foreign('carro_id')->references('id')->on('carros');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locacaos');
    }
};
