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
        Schema::create('comunicados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo');
            $table->text('texto_vista_previa');
            $table->text('descripcion');
            $table->dateTime('fecha');
            $table->string('imagen_comunicados'); // Campo para la ruta de la imagen
            $table->binary('archivo_pdf');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comunicados');
    }
};

