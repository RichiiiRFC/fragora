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
        Schema::create('articulos_carrito', function (Blueprint $table) {
            $table->increments('id'); 
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('productos')->onDelete('cascade');
            $table->unsignedInteger('cart_id');
            $table->foreign('cart_id')->references('id')->on('carrito')->onDelete('cascade');
            $table->Integer('amount')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulos_carrito');
    }
};
