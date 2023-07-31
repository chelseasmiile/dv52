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
        Schema::create('slidercreate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->dateTime('fecha');
            $table->text('texto_vista_previa');
            $table->binary('imagen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slidercreate');
    }
};
