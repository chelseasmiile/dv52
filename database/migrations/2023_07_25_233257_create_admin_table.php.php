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
         Schema::create('administradores', function (Blueprint $table) {
             $table->bigIncrements('id');
             $table->string('nombre');
             $table->string('email')->unique(); // Cambia aquí
             $table->string('contrasena');
             $table->timestamps();
         });
     }

    public function down()
    {
        Schema::dropIfExists('administradores');
    }
};
