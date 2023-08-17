
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
        Schema::create('galeria', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('categoria');
            $table->string('titulo');
            $table->text('texto_vista_previa');
            $table->text('descripcion');
            $table->dateTime('fecha');
            $table->string('participantes');
            $table->binary('imagen_galeria');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('galeria');
    }
};
