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
        Schema::create('quienessomos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('vision', 1000);
            $table->string('mision',1000);
            $table->string('valores',1000);
            $table->binary('imagen_vision');
            $table->binary('imagen_mision');
            $table->binary('imagen_valores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quienessomos');
    }
};
