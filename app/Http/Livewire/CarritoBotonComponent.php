<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CarritoBotonComponent extends CarritoComponent
{
    protected $listeners = ['addProducto' , 'addFavorito' , 'productoAgregadoCarrito' => '$refresh'];

    public function render()
    {
        $items = \Cart::getContent();
        $impuesto = $this->impuesto();
        $cantidad = $items->count();

        $data = [
            'cantidad' => $cantidad,
            'impuesto' => $impuesto,
            'items' => $items,
        ];

        return view('livewire.carrito-boton-component' , $data);
    }
}
