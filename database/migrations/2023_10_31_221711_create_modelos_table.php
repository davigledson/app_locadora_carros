<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

//MODELOS
public function up()
{
    Schema::create('modelos', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('marca_id');
        $table->string('nome', 30);
        $table->string('imagem', 100);
        $table->integer('numero_portas');
        $table->integer('lugares');
        $table->boolean('air_bag');
        $table->boolean('abs');
        $table->timestamps();

        //foreign key (constraints)
        $table->foreign('marca_id')->references('id')->on('marcas');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modelos');
    }
};
