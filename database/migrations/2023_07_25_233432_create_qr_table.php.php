<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('generador_qr', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('identificador');
            $table->string('titulo');
            $table->dateTime('fecha');
            $table->text('descripcion');
            $table->string('participantes');
            $table->unsignedBigInteger('galeria_id'); // Agrega esta línea para crear la columna
            $table->timestamps();

            $table->foreign('galeria_id')->references('id')->on('galeria')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('generador_qr');
    }
};