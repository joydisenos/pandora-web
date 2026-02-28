<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;

class DetalleComponent extends Component
{
    public $productoId , $aumento , $talla , $medida , $color , $tallaSeleccionada , $colorSeleccionado;

    protected $listeners = ['cambiarProducto'];

    public function mount($productoId)
    {
        $this->productoId = $productoId;
        $this->aumento = 1;
    }

    public function cambiarProducto($id , $index = 0 , $slideSku = null)
    {
        $this->productoId = $id;
        // $this->emit('render_prod_pics' , $index);
        $this->emit('goToSlide' , $slideSku );
    }

    public function selectTalla($talla)
    {
        $this->tallaSeleccionada = $talla;
    }
    
    public function selectColor($color)
    {
        $this->colorSeleccionado = $color;
    }

    public $cantidad = 1;

    public function agregarAlCarrito()
    {
        // Validar si el producto tiene tallas y no se ha seleccionado una
        $producto = Producto::find($this->productoId);
        $tallas = trim($producto->talla) ? explode(',' , trim($producto->talla)) : [];
        $colores = trim($producto->color) ? explode(',' , trim($producto->color)) : [];

        if(count($tallas) > 0 && !$this->tallaSeleccionada)
        {
            $this->emit('notificar' , [
                'mensaje' => 'Por favor seleccione una talla',
                'tipo' => 'error',
            ]);
            return;
        }

        if(count($colores) > 0 && !$this->colorSeleccionado)
        {
            $this->emit('notificar' , [
                'mensaje' => 'Por favor seleccione un color',   
                'tipo' => 'error',
            ]);
            return;
        }

        $this->emit('addProducto' , $this->productoId , $this->cantidad , $this->tallaSeleccionada , $this->colorSeleccionado);
    }

    public function render()
    {
        $producto = Producto::find($this->productoId);
        $tallas = trim($producto->talla) ? explode(',' , trim($producto->talla)) : [];
        $colores = trim($producto->color) ? explode(',' , trim($producto->color)) : [];

        if($producto->video_link)
        {
            $this->aumento = 2;
        }

        $variablePrecio = $producto->padre ? $producto->padre->variablePrecio : $producto->variablePrecio;

        $data = [
            'producto' => $producto,
            'tallas' => $tallas,
            'colores' => $colores,
            'variablePrecio' => $variablePrecio,
            'variantes' => $producto->variantes($this->talla , $this->medida , $this->color),
            'comentarios' => $producto->padre ? $producto->padre->comentarios : $producto->comentarios,
            'subproductos' => Producto::where(function($query) use($producto){
                $query->where('id_padre', $producto->id)
                        ->orWhere('id_padre', $producto->id_producto);
            })->where('estatus', 1)->get(),
        ];

        return view('livewire.detalle-component' , $data);
    }
}
