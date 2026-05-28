<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Favorito;

class CarritoComponent extends Component
{
    public $cantidades = [] , $userId;
    protected $listeners =['addProducto' , 'addFavorito' , 'updateCantidad'];

    public function mount()
    {
        $this->userId = auth()->user() ? auth()->user()->id : null;

        if($this->userId)
        {
            \Cart::session($this->userId);
        }

        $items = \Cart::getContent();

        foreach ($items as $key => $item) {
            $this->cantidades[$key] = $item->quantity;
        }
    }

    public function updatedCantidades($cant , $index)
    {
        // dd( $cant , $index);
        $this->updateCantidad($index , $cant);
    }

    public function updateCantidad($id , $cantidad)
    {
        if($this->userId)
        {
            \Cart::session($this->userId);
        }

        $this->cantidades[$id] = $cantidad;
        // actualizar Carrito
        
        $producto = Producto::find($id);

        \Cart::update( $id , [
            'quantity'=>[
                'relative' => false,
                'value' =>$cantidad
            ]
        ]);

        $this->validarPrecios($producto);
        
    }

    public function validarPrecios($producto)
    {
        $cantidadTotal = 0;
        if($producto->padre)
        {
            $padre = $producto->padre;
            $variantes = [$producto->id];
            // Buscar Variantes
            foreach($padre->variantes() as $var)
            {
                $variantes[] = $var->id;
            }
            $items = \Cart::getContent()->whereIn('id' , $variantes);
            // Buscar Items Con variantes
            foreach($items as $item)
            {
               $cantidadTotal = $cantidadTotal + (int)$item->quantity; 
            }
            // Actualizar Precios de los items con variantes
            foreach($items as $item)
            {
                \Cart::update( $item->id , [
                    'price' => $producto->precio($cantidadTotal)
                ]);
            } 
        }

        // par productos Padres o independientes
        if($producto->padre == null)
        {
            $items = \Cart::getContent()->where('id' , $producto->id);
            // Buscar Items Con variantes
            foreach($items as $item)
            {
               $cantidadTotal = $cantidadTotal + (int)$item->quantity; 
            }
            // Actualizar Precios de los items con variantes
            foreach($items as $item)
            {
                \Cart::update( $item->id , [
                    'price' => $producto->precio($cantidadTotal)
                ]);
            } 
        }
    }

    public function render()
    {
        if($this->userId)
        {
            \Cart::session($this->userId);
        }

        $items = \Cart::getContent()->sortBy('id');
        $subtotal = \Cart::getSubtotal();
        $impuesto = $this->impuesto();
        $total = $subtotal + $impuesto;
        // dd($items);
        $data = [
            'items' => $items,
            'subtotal' => $subtotal,
            'impuesto' => $impuesto,
            'total' => $total,
        ];

        return view('livewire.carrito-component' , $data);
    }

    public function impuesto()
    {
        $total = 0;
        foreach(\Cart::getContent() as $item)
        {
            $total += $this->totalImpuesto($item);
        }

        return $total;
    }

    public function totalImpuesto($item)
    {
        $total = $item['price'] * $item['quantity'];
        $impuesto = $total * ($item->associatedModel->impuesto() / 100);

        return $impuesto;
    }

    public function addProducto($id , $cantidad = 1 , $talla = null, $color = null)
    {
        if($this->userId)
        {
            \Cart::session($this->userId);
        }

        $producto = Producto::find($id);
        
        $nombreProducto = $producto->nombre;
        if($talla)
        {
            $nombreProducto .= ' - ' . $talla;
        }

        if($color)
        {
            $nombreProducto .= ' - ' . $color;
        }
        
        \Cart::add(array(
            'id' => $id . ($talla ? '-' . $talla : '') . ($color ? '-' . $color : ''), // Unique ID for size variant
            'name' => $nombreProducto,
            'price' => $producto->precio($cantidad),
            'quantity' => $cantidad,
            'attributes' => array(
                'imagen' => $producto->imagen(),
                'talla' => $talla,
                'color' => $color
            ),
            'associatedModel' => $producto
        ));

        $this->validarPrecios($producto);

        $this->emit('notificar' , [
            'mensaje' => 'Producto agregado al carrito',
            'tipo' => 'success',
        ]);
    }
    
    private function getWishlistSessionKey()
    {
        return auth()->check() ? 'wishlist_'.auth()->id() : 'wishlist_'.session()->getId();
    }

    public function addFavorito($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return;
        }

        $sessionKey = $this->getWishlistSessionKey();
        
        $item = \Cart::session($sessionKey)->get($id);

        if($item)
        {
            \Cart::session($sessionKey)->remove($id);
            $this->emit('notificar' , [
                'mensaje' => 'Producto eliminado de favoritos',
                'tipo' => 'info',
            ]);
        } else {
            \Cart::session($sessionKey)->add(array(
                'id' => $id,
                'name' => $producto->nombre,
                'price' => $producto->precio,
                'quantity' => 1,
                'attributes' => array(
                    'imagen' => $producto->imagen(),
                ),
                'associatedModel' => $producto
            ));

            $this->emit('notificar' , [
                'mensaje' => 'Producto agregado a Favoritos',
                'tipo' => 'success',
            ]);
        }
        
        $this->emit('wishlistUpdated');
    }
    
    public function removeProducto($id)
    {
        if($this->userId)
        {
            \Cart::session($this->userId);
        }
        
        \Cart::remove($id);
        
        // $producto = Producto::find($id);
        // $this->validarPrecios($producto);

        $this->emit('cartRemoved' , $id);
    }

    public function clearCarrito()
    {
        if($this->userId)
        {
            \Cart::session($this->userId);
        }

        \Cart::clear();
        
        $this->emit('cartCleared');
    }
    
}
