<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;

class DetalleModalComponent extends DetalleComponent
{
    public $productoId;

    public function mount($productoId)
    {
        $this->productoId = $productoId;
    }

    public function render()
    {
        $data = [
            'producto' => Producto::find($this->productoId),
        ];

        return view('livewire.detalle-modal-component' , $data);
    }
}
