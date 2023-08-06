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
            $table->string('identificador')->unique();
            $table->string('titulo');
            $table->dateTime('fecha');
            $table->text('descripcion');
            $table->string('participantes');
            $table->binary('imagen_qr');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('generador_qr');
    }
};