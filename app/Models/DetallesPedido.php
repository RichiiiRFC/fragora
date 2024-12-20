<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesPedido extends Model
{
    use HasFactory;

    protected $table = 'detalles_pedido';

    public $timestamps = false;


    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
