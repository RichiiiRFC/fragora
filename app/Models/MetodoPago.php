<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    use HasFactory;
    protected $table = 'metodos_pago';
    public $timestamps = false;

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
