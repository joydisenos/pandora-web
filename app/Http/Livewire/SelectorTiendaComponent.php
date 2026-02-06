<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SelectorTiendaComponent extends Component
{
    public $userId , $selector;

    public function mount()
    {
        $this->userId = auth()->user() ? auth()->user()->id : null;
    }

    public function render()
    {
        if($this->userId)
        {
            \Cart::session($this->userId);
        }

        $carrito = \Cart::getContent();

        $data = [
            'carrito' => $carrito,
            'tiendas' => tiendasDisponibles(),
        ];

        return view('livewire.selector-tienda-component' , $data);
    }
}
