<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Orden;
use App\Models\OrdenItem;
use App\Models\Cliente;
use App\Models\Producto;

class OrdenesComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $buscar , $modo , $ordenId , $items , $producto , $sugerencias , $sugerenciasProductos , $orden , $estatus;
    protected $listeners = ['buscar'];

    public function buscar($buscar)
    {
        $this->buscar = $buscar;
    }

    public function mount()
    {
        $this->modo = 'lista';
        $this->items = [];
        $this->orden['estatus'] = 1;
        $this->orden['impuesto'] = opcionSlug('impuesto');
        $this->sugerencias = [];
        $this->sugerenciasProductos = [];
    }

    public function updatedOrdenCedula($dni)
    {
        $this->sugerencias = Cliente::where('cedula' , 'like' , '%' . $dni . '%')
                                    ->limit(5)
                                    ->get();
        if(!$dni)
        {
            $this->sugerencias = [];
        }
    }
    
    public function updatedProductoNombre($nombre)
    {
        $this->sugerenciasProductos = Producto::where('nombre' , 'like' , '%' . $nombre . '%')
                                    ->limit(5)
                                    ->get();
        if(!$nombre)
        {
            $this->sugerenciasProductos = [];
        }
    }

    public function setCliente(Cliente $cliente)
    {
        $this->orden['cliente_id'] = $cliente->id;
        $this->orden['nombre'] = $cliente->nombre;
        $this->orden['apellido'] = $cliente->apellido;
        $this->orden['cedula'] = $cliente->cedula;
        $this->orden['direccion'] = $cliente->direccion;
        $this->sugerencias = [];
    }
    
    public function setProducto(Producto $producto)
    {
        $this->producto['producto_id'] = $producto->id;
        $this->producto['id_producto'] = $producto->id_producto;
        $this->producto['impuesto'] = $producto->impuesto();
        $this->producto['nombre'] = $producto->nombre;
        $this->producto['precio'] = $producto->precio;
        $this->producto['cantidad'] = 1;
        $this->sugerenciasProductos = [];
    }

    public function render()
    {
        $ordens = new Orden();

        if($this->buscar)
        {
            $ordens = $ordens->where(function($query){
                $query->where('nombre' , 'like' , '%' . $this->buscar . '%')
                ->orWhere('apellido' , 'like' , '%' . $this->buscar . '%')
                ->orWhereRaw("CONCAT(TRIM(nombre), ' ' ,TRIM(apellido)) like ?", ["%{$this->buscar}% "])      
                ->orWhere('cedula' , 'like' , '%' . $this->buscar . '%')
                ->orWhere('id' , 'like' , '%' . $this->buscar . '%')
                ->orWhere('email' , 'like' , '%' . $this->buscar . '%');
            });
        }

        if($this->estatus != null && $this->estatus != '')
        {
            $ordens = $ordens->where('estatus' , $this->estatus);
        }

        $ordens = $ordens->orderBy('id' , 'desc')
                            // ->where('estatus' , '!=' , 2)                    
                            ->paginate(10);

        $data = [
            'ordens' => $ordens,
        ];

        return view('livewire.ordenes-component' , $data);
    }

    public function edit(Orden $orden)
    {
        $this->orden = $orden->toArray();
        $this->ordenId = $orden->id;
        $this->setItems($orden);
        $this->modo = 'edit';
    }
    
    public function delete($id)
    {
        $orden = Orden::find($id);
        $items = OrdenItem::where('orden_id' , $id)->delete();
        $orden->delete();
    }

    public function setItems(Orden $orden)
    {
        foreach($orden->items as $item)
        {
            $this->items[] = $item->toArray();
        }
    }

    public function impuesto()
    {
        if(isset($this->orden['impuesto']))
        {
            // anterior calculo de impueto
            // return round(( (float)$this->orden['impuesto'] / 100) * $this->subtotal() , 2);
        }

        $total = 0;
        foreach($this->items as $item)
        {
            $total += $this->totalImpuesto($item);
        }

        return $total;
    }
    
    public function impuestoPorcentaje()
    {
        if(isset($this->orden['impuesto']))
        {
            return (float)$this->orden['impuesto'] . '%';
        }

        return 0 . '%';
    }
    
    public function subtotal()
    {
        $total = 0;

        foreach($this->items as $item)
        {
            $total += $this->subtotalItem($item);
        }

        return round($total , 2);
    }

    public function envio()
    {
        $envio = isset($this->orden['envio']) && $this->orden['envio'] ? $this->orden['envio'] : 0;

        return $envio;
    }
    
    public function total()
    {
        $total = $this->subtotal() + $this->impuesto() + $this->envio();

        return round($total , 2);
    }

    public function save()
    {
        $this->validate([
            'orden.nombre' => 'required',
            'orden.apellido' => 'required',
            'orden.cedula' => 'required',
        ]);

        if (!preg_match("/^[0-9-]+$/", $this->orden['cedula'])) {
            return $this->addError('orden.cedula', 'Sólo debe tener caracteres numéricos o guiones.');
        }

        $cliente = Cliente::where('cedula' , $this->orden['cedula'])->first();

        if(!$cliente)
        {
            $cliente = Cliente::create([
                'nombre' => $this->orden['nombre'],
                'apellido' => $this->orden['apellido'],
                'cedula' => $this->orden['cedula'],
                'direccion' => $this->orden['direccion'],
            ]);

            $this->orden['cliente_id'] = $cliente->id;
        }

        if($this->ordenId)
        {
            $orden = Orden::find($this->ordenId);
            $orden->update($this->orden);
        }

        if(!$this->ordenId)
        {
            $orden = Orden::create($this->orden);
        }

        $orden->syncItems($this->items);

        $this->resetForm();
    }

    public function crear()
    {
        $this->orden = [];
        $this->modo = 'edit';
    }

    public function resetForm()
    {
        $this->orden = [];
        $this->orden['estatus'] = 1;
        $this->orden['impuesto'] = opcionSlug('impuesto');
        $this->items = [];
        $this->ordenId = null;
        $this->modo = 'lista';
    }

    public function addItem()
    {
        $this->validate([
            'producto.nombre' =>'required',
            'producto.cantidad' =>'required',
            'producto.precio' =>'required',
        ]);

        if(!isset($this->producto['impuesto']))
        {
            $this->producto['impuesto'] = 0;
        }

        $this->items[] = $this->producto;
        $this->producto = [];
    }

    public function precioItem($item)
    {
        $total = $item['precio'] * $item['cantidad'];
        $impuesto = $total * ($item['impuesto'] / 100);

        return $total + $impuesto;
    }
    
    public function totalImpuesto($item)
    {
        $total = $item['precio'] * $item['cantidad'];
        $impuesto = $total * ($item['impuesto'] / 100);

        return $impuesto;
    }
    
    public function subtotalItem($item)
    {
        $total = $item['precio'] * $item['cantidad'];

        return $total;
    }
    
    public function removeItem($key)
    {
        unset($this->items[$key]);
    }
}
