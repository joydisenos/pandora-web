<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;

    // protected $guarded = [];
    protected $fillable = [
        'cliente_id', 
        'tienda',
        'nombre',
        'apellido',
        'cedula',
        'provincia',
        'distrito',
        'corregimiento',
        'barrio',
        'direccion',
        'provincia_envio',
        'distrito_envio',
        'corregimiento_envio',
        'barrio_envio',
        'direccion_envio',
        'transportista',
        'retiro',
        'email',
        'telefono',
        'codigo_telefono',
        'user_id',
        'precio',
        'impuesto',
        'envio',
        'descuento',
        'tipo_pago',
        'moneda',
        'recomendaciones',
        'estatus',
    ];

    public function syncItems(Array $items)
    {
        OrdenItem::where('orden_id' , $this->id)
                    ->delete();
        
        $total = 0;

        foreach($items as $item)
        {
            $item['orden_id'] = $this->id;
            
            if(!isset($item['impuesto']))
            {
                $item['impuesto'] = opcionSlug('impuesto') ? opcionSlug('impuesto') : 0;
            }

            $impuesto = $item['impuesto'] ;
            
            $itemCreado = OrdenItem::create($item);

            $totalItem = $item['precio'] * $item['cantidad'];
            $impuestoItem = $totalItem * ($impuesto / 100);

            $total += $totalItem + $impuestoItem;
        }
        
        $this->precio = $total;
        $this->save();

        return true;
    }
    
    public function descontarInventario(Array $items , $tiendaId = null)
    {
        if(!$tiendaId)
        {
            $tiendaId = currentTienda();
        }
        
        foreach($items as $item)
        {
            if(isset($item['producto_id']))
            {
                $producto = Producto::find($item['producto_id']);
                if($producto)
                {
                    $producto->descontarInventario($tiendaId , $item['cantidad']);
                }
            }
        }
    }

    public function precioConImpuesto()
    {
        // Anterior funcion para impuesto general
        // return ($this->precio * ($this->impuesto / 100)) + $this->envio + $this->precio;
        return $this->envio + $this->precio;
    }

    public function nombreCompleto()
    {
        return $this->nombre . ' ' . $this->apellido;
    }

    public function items()
    {
        return $this->hasMany(OrdenItem::class , 'orden_id');
    }

    public function itemsNombres()
    {
        $compras = [];

        foreach($this->items as $item)
        {
            $compras[] = $item->nombre . ' x' . $item->cantidad;
        }

        return implode( ', ' , $compras);
    }

    public function tienda()
    {
        if(!$this->tienda)
        {
            return 'No definido';
        }

        $tienda = tiendaName($this->tienda);

        return $tienda;
    }

    public function estatus()
    {
        switch ($this->estatus) {
            case 0:
                $out = 'Negado';
                break;
            case 1:
                $out = 'Pendiente';
                break;
            case 2:
                $out = 'Aprobado';
                break;
            
            default:
                $out = 'No definido';
                break;
        }

        return $out;
    }
}
