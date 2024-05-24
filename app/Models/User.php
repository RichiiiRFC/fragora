<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

     public function direccion()
    {
        return $this->hasOne(Direccion::class);
    }

     public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    
   
    protected $fillable = [
        'name',
        'apellidos',
        'email',
        'rol',
        'password',
    ];

   
    protected $hidden = [
        'password',
        'remember_token',
    ];

  
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
