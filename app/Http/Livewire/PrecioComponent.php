<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PrecioComponent extends Component
{
    public $productoId , $cantidad;
    protected $listeners = ['updateCantidad'];
    
    public function mount($productoId)
    {
        $this->productoId = $productoId;
        $this->cantidad = 1;
    }
    
    public function updateCantidad($productoId , $cantidad)
    {
        $this->cantidad = $cantidad;
    }

    public function render()
    {
        $precio = findProducto($this->productoId)->precio($this->cantidad);

        $data = [
            'precio' => $precio
        ];

        return view('livewire.precio-component' , $data);
    }
}
