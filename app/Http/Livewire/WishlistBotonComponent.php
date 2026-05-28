<?php

namespace App\Http\Livewire;

use Livewire\Component;

class WishlistBotonComponent extends Component
{
    protected $listeners = ['wishlistUpdated' => '$refresh'];

    public function render()
    {
        $sessionKey = auth()->check() ? 'wishlist_'.auth()->id() : 'wishlist_'.session()->getId();
        $cantidad = \Cart::session($sessionKey)->getContent()->count();

        return view('livewire.wishlist-boton-component', compact('cantidad'));
    }
}
