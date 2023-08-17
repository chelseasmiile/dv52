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
        Schema::create('principal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slider1', 1000);
            $table->string('slider2',1000);
            $table->string('slider3',1000);
            $table->binary('imagen_s1');
            $table->binary('imagen_s2');
            $table->binary('imagen_s3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('principal');
    }
};
