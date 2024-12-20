<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodoEnvio extends Model
{
    use HasFactory;
    protected $table = 'metodos_envio';
    public $timestamps = false;

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
