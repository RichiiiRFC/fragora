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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id')->startingValue(1000000);
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('usuario_telefono',20);
            $table->string('usuario_direccion', 150);
            $table->string('usuario_ciudad',50);
            $table->string('usuario_provincia',50);
            $table->string('usuario_cod_postal', 20);
            $table->string('usuario_pais', 50);
            $table->decimal('total_precio', 10, 2);
            $table->string('metodo_pago', 50);
            $table->string('metodo_envio', 50);
            $table->string('estado', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
