<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetodosEnvioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metodos_envio', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('nombre', 50);
            $table->string('descripcion', 255)->nullable();
            $table->decimal('costo', 10, 2);
            $table->boolean('activo')->default(true);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metodos_envio');
    }
}
