<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagenesGaleriaTable extends Migration
{
    public function up()
    {
        Schema::create('imagenes_galeria', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('galeria_id');
            $table->string('imagen');
            $table->timestamps();

            $table->foreign('galeria_id')->references('id')->on('galeria')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('imagenes_galeria');
    }
}