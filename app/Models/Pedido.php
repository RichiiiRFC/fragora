<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $table = 'pedidos';

     public function detalles()
    {
        return $this->hasMany(DetallesPedido::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
