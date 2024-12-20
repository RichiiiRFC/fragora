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
        $carrito = new Carrito();
        $carrito->user_id = $user->id;
        $carrito->save();
    }


    if ($this->request->hasCookie($cookieName)) {
        $carritoTemporal = json_decode($this->request->cookie($cookieName), true);

      
        foreach ($carritoTemporal as $productId => $details) {
          
            $existingProduct = $carrito->productos()->where('product_id', $productId)->first();

            if ($existingProduct) {
            
                $carrito->productos()->updateExistingPivot($productId, [
                    'amount' => $existingProduct->pivot->amount + $details['amount']
                ]);
            } else {
               
                $carrito->productos()->attach($productId, ['amount' => $details['amount']]);
            }
        }

     
        Cookie::queue(Cookie::forget($cookieName));
    }
}

}