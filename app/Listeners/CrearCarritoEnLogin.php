<?php

namespace App\Listeners;

use App\Models\Carrito;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

class CrearCarritoEnLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Authenticated  $event
     * @return void
     */
    public function handle(Authenticated $event)
    {
        $user = $event->user;
        $cookieName = 'carrito_temporal';
        $carrito = Carrito::where('user_id', $user->id)->first();

    
        if (!$carrito) {
            
            //Si no tiene carrito temporal creamos directamente un carrito, ya que no hay nada que recuperar temporal
            if(!$this->request->hasCookie($cookieName)){
                $carrito = new Carrito();
                $carrito->user_id = $user->id;
                $carrito->save();
            }else{
                //Si el usuario no tiene un carrito en la base de datos, pero tiene uno temporal
                $carritoTemporal = json_decode($this->request->cookie($cookieName), true);
                $carrito = new Carrito();
                $carrito->user_id = $user->id;
                $carrito->save();
                foreach ($carritoTemporal as $productId => $details) {
                    $carrito->productos()->attach($productId, ['amount' => $details['amount']]);
                }

                // Eliminamos la cookie temporal
                Cookie::queue(Cookie::forget($cookieName));
                }
        }
    }
}