<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ref', 20)->unique(); 
            $table->string('nombre', 100);
            $table->string('marca', 50);
            $table->string('concentracion', 50);
            $table->string('categoria', 50);
            $table->integer('ml');
            $table->text('descripcion');
            $table->decimal('descuento', 5, 2)->default(0);
            $table->decimal('precio_base', 10, 2);
            $table->decimal('precio', 10, 2);
            $table->integer('stock');
            $table->string('imagen', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
