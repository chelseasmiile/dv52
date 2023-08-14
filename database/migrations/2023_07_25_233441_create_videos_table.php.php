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
    Schema::create('videos', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('titulo');
        $table->string('youtube_video_id'); // Campo para almacenar el ID del video de YouTube
        $table->string('miniatura')->nullable();
        $table->text('descripcion');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('videos');
}

};
