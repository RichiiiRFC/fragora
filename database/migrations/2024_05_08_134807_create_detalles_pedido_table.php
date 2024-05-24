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
        Schema::create('detalles_pedido', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pedido_id');
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
            $table->string('producto_ref', 20);
            $table->string('producto_nombre', 100);
            $table->string('producto_marca', 50);
            $table->integer('producto_ml');
            $table->string('producto_concentracion', 50);
            $table->string('producto_categoria', 50);
            $table->decimal('producto_precio', 10, 2);
            $table->string('producto_imagen', 255)->nullable();
            $table->integer('cantidad');
            $table->decimal('subtotal', 10, 2);
            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_pedido');
    }
};
