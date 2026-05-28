<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;

class WishlistComponent extends Component
{
    public function removeFavorito($id)
    {
        $sessionKey = auth()->check() ? 'wishlist_'.auth()->id() : 'wishlist_'.session()->getId();
        \Cart::session($sessionKey)->remove($id);

        $this->emit('wishlistUpdated');
        
        $this->emit('notificar' , [
            'mensaje' => 'Producto eliminado de favoritos',
            'tipo' => 'info',
        ]);
    }

    public function render()
    {
        $sessionKey = auth()->check() ? 'wishlist_'.auth()->id() : 'wishlist_'.session()->getId();
        $cartItems = \Cart::session($sessionKey)->getContent();
        
        $productIds = $cartItems->pluck('id')->toArray();

        // Get only active and existing products
        $productos = Producto::whereIn('id', $productIds)
            ->where('estatus', 1)
            ->where('flag_activo', 1)
            ->get();

        // Cleanup wishlist items that are no longer active/existing
        $validIds = $productos->pluck('id')->toArray();
        $removedAny = false;
        
        foreach ($productIds as $id) {
            if (!in_array($id, $validIds)) {
                \Cart::session($sessionKey)->remove($id);
                $removedAny = true;
            }
        }

        if ($removedAny) {
            $this->emit('wishlistUpdated');
        }

        return view('livewire.wishlist-component', compact('productos'));
    }
}
