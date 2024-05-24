<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Carrito extends Model
{

    use HasFactory;
    protected $table = 'carrito';
    public $timestamps = false;
    

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'articulos_carrito','cart_id', 'product_id')
            ->withPivot('amount');
    }

}