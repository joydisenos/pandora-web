<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;

class ProductoDetalleComponent extends Component
{
    public $productoId , $producto , $cantidad;

    public function mount($productoId)
    {
        $this->cantidad = 1;
        $this->productoId = $productoId;
        $this->producto = Producto::find($productoId);
    }

    public function aumentar()
    {
        $this->cantidad ++;
    }

    public function disminuir()
    {
        if($this->cantidad > 1)
        {
            $this->cantidad --;
        }
    }

    public function agregarCarrito($redirect = false)
    {
        $producto = Producto::find($this->productoId);

        \Cart::add(array(
            'id' => $this->productoId,
            'name' => $producto->nombre,
            'price' => $producto->precio,
            'quantity' => $this->cantidad,
            // 'attributes' => array(),
            'associatedModel' => $producto
        ));

        $this->emit('productoAgregadoCarrito');
        
        $this->emit('notificar' , [
            'mensaje' => 'Producto agregado al carrito',
            'tipo' => 'success',
        ]);

        if($redirect)
        {
            return redirect()->route('carrito');
        }
    }

    public function render()
    {
        return view('livewire.producto-detalle-component');
    }
}
