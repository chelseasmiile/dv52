<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Nombre',35)->comment('Este es el nombre del remitente');
            $table->string('Seccion',25)->comment('Esta es la seccion sindical a la que pertenece el remitente');
            $table->string('Mensaje',255)->comment('Este es el mensaje que quiere atender el remitente');
            $table->string('Correo',45)->comment('Este es el correo del remitente');
            $table->string('Telefono',10)->comment('Este es el numero telefonico del remitente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensajes');
    }
};


