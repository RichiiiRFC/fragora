<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDireccionesTable extends Migration
{
    public function up(): void
    {
        Schema::create('direcciones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('direccion')->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('ciudad')->nullable();
            $table->string('provincia', 50)->nullable();
            $table->string('cod_postal', 20)->nullable();
            $table->string('pais', 50)->nullable();
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('direcciones');
    }
}
