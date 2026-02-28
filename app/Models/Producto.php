<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function comentarios()
    {
        return $this->hasMany(Comentario::class , 'producto_id')
                        ->where('estatus' , 1)
                        ->orderBy('id' , 'desc');
    }

    public function stockTienda()
    {
        return $this->hasMany(TiendaStock::class , 'producto_id');
    }

    public function syncStocks($stocks)
    {
        TiendaStock::where('producto_id' , $this->id)->delete();

        foreach($stocks as $key => $stock)
        {
            TiendaStock::create([
                'tienda_id' => $key,
                'producto_id' => $this->id,
                'stock' => $stock
            ]);
        }
    }

    public function descontarInventario($tiendaId , $cantidad)
    {
        $stock = TiendaStock::where('tienda_id' , $tiendaId)
                            ->where('producto_id' , $this->id)
                            ->first();
        
        $stock->stock = $stock->stock - $cantidad;
        $stock->save();
    }

    public function disponible($tienda = null , $detallado = null )
    {
        if(!$tienda)
        {
            $tienda = currentTienda();
        }

        $stock = TiendaStock::where('tienda_id' , $tienda)
                    ->where('producto_id' , $this->id)
                    ->first();

        if(!$stock)
        {
            return 0;
        }

        return $stock->stock;
        
        // funcion vieja
        if($tienda == null)
        {
            $tienda = tiendaName(currentTienda());
        }
        
        if($this->stock_tienda == null)
        {
            return 0;
        }

        $stocks = collect(json_decode($this->stock_tienda));

        $stocks = $stocks->where('tienda' , $tienda)->first();
        
        if(!$stocks)
        {
            return 0;
        }
        
        // Para reporte de Inventario
        if($detallado)
        {
            return $stocks->cantidad;
        }

        // Bloquear producto con stock bajo
        if($stocks->cantidad <= 10)
        {
            return 0;
        }

        return $stocks->cantidad;
    }
    
    public function disponibleGeneral($tienda = null , $detallado = null )
    {
        $stock = TiendaStock::where('producto_id' , $this->id)
                                ->get();

        if(!$stock->count())
        {
            return 0;
        }

        return $stock->sum('stock');
    }
    

    public function padre()
    {
        return $this->belongsTo(Producto::class , 'id_padre' , 'id_producto');
    }

    public function detalles()
    {
        if($this->detalles)
        {
            return $this->detalles;
        }

        if($this->padre && $this->detalles == null){
            return $this->padre->detalles;
        }
        
        return null;
    }
    
    public function fichaPrincipal()
    {
        if($this->ficha)
        {
            return $this->ficha();
        }

        if($this->padre){
            return $this->padre->ficha();
        }
        
        return null;
    }

    public function variantesFiltros($campo)
    {
        if($this->id_producto == null)
        {
            return collect([]);
        }

        $productos = Producto::where(function($query){
            $query->where('id_padre' , $this->id_producto)    
            ->orWhere(function($query){
                $query->where('id_padre' , '!=' , null)
                        ->where('id_padre' , $this->id_padre);
            });
        })
        ->where('estatus' , 1 )
        ->where('flag_activo' , 1 )
        ->where($campo , '!=' , null)
        ->groupBy($campo);

        return $productos->get();
    }

    public function variantes($talla = null , $medida = null , $color = null)
    {
        if($this->id_producto == null)
        {
            return collect([]);
        }
        
        // $productos = Producto::where('id_padre' , $this->id_producto)
        //                             ->orWhere(function($query){
        //                                 $query->orWhere(function($query){
        //                                     $query->where('id_producto' , '!=' , null)
        //                                             ->where('id_producto' , $this->id_padre);
        //                                 })
        //                                 ->orWhere(function($query){
        //                                     $query->where('id_padre' , '!=' , null)
        //                                             ->where('id_padre' , $this->id_padre);
        //                                 });
        //                         })
        //                         ->get();
        // 
        
        $productos = Producto::where(function($query){
                                    $query->where('id_padre' , $this->id_producto)    
                                    ->orWhere(function($query){
                                        $query->where('id_padre' , '!=' , null)
                                                ->where('id_padre' , $this->id_padre);
                                    });
                                })
                                ->where('estatus' , 1 )
                                ->where('flag_activo' , 1 );

        if($talla)
        {
            $productos = $productos->where('talla' , $talla);
        }

        if($medida)
        {
            $productos = $productos->where('medida' , $medida);
        }

        if($color)
        {
            $productos = $productos->where('color' , $color);
        }

        return $productos->get();
    }

    public function comentariosPromedio()
    {
        if($this->padre)
        {
            return round($this->padre->comentarios()->avg('puntos')); 
        }
        
        return round($this->comentarios()->avg('puntos'));
    }

    public function precio($cantidad = 1)
    {
        if($this->precio == 0 && $this->subProductos()->count())
        {
            $prod = $this->subProductos()->first();
            if($prod)
            {
                return $prod->precio;
            }
        }
        // if($this->variablePrecio->count())
        // {
        //     return $this->consultarPrecio($this->id , $cantidad);
        // }

        // if($this->padre && $this->padre->variablePrecio->count())
        // {
        //     return $this->consultarPrecio($this->padre->id , $cantidad);
        // }
        
        return $this->precio;
    }

    public function consultarPrecio($productoId , $cantidad)
    {
        $precio = Precio::where('producto_id' , $productoId)
                            ->where('cantidad' , '<=' , $cantidad)
                            ->orderBy('cantidad' , 'desc')
                            ->first();

        $precioProd = Producto::find($productoId)->precio;

            if($precio)
            {
                if($precio->tipo == 1)
                {
                    return $precio->precio;
                }

                if($precio->tipo == 2)
                {
                   
                    return $precioProd  - (($precio->porcentaje / 100) * $precioProd);
                }
            }

            return $precioProd;
    }

    public function estatus()
    {
        switch ($this->estatus) {
            case 1:
                $out="Activo";
                break;
            case 0:
                $out="Oculto";
                break;
            
            default:
                $out="Oculto";
                break;
        }

        return $out;
    }
    
    public function tienda()
    {
        $out = tiendaNombre($this->tienda);

        return $out;
    }
    
    public function descuentoPorcentaje()
    {
        if($this->precio == null || $this->antes == null)
        {
            return 0;
        }

        $ahorro = $this->antes - $this->precio;

        if($ahorro == 0)
        {
            return 0;
        }

        return ceil(100 / ($this->antes / $ahorro));
    } 

    public function estatusSlider()
    {
        switch ($this->slider) {
            case 1:
                $out="Activo";
                break;
            case 0:
                $out="Oculto";
                break;
            
            default:
                $out="Oculto";
                break;
        }

        return $out;
    }

    public function galeria()
    {
        return $this->hasMany(Galeria::class , 'producto_id');
    }
    
    public function variablePrecio()
    {
        return $this->hasMany(Precio::class , 'producto_id');
    }

    public function syncPrecios($array)
    {
        Precio::where('producto_id' , $this->id)->delete();

        foreach($array as $item){
            unset($item['id']);
            Precio::create($item);
        }
    }

    public function esIndependiente()
    {
        return $this->id_tipo_articulo == 3 ? true : false;
    }

    public function relacionados($limit = 4)
    {
        $productos = Producto::where('estatus' , 1 )
                                ->where('id' , '!=' , $this->id)
                                ->where('categoria_id' , $this->categoria_id)
                                ->where('id_padre' , null)
                                ->orderBy('id' , 'desc')
                                ->limit($limit)
                                ->get();

        return $productos;
    }
    
    public function relacionadosSiguiente()
    {
        $producto = Producto::where('estatus' , 1 )
                                ->where('id' , '>' , $this->id)
                                ->where('categoria_id' , $this->categoria_id)
                                ->where('id_padre' , null)
                                ->orderBy('id' , 'asc')
                                ->first();

        return $producto;
    }
    
    public function relacionadosAnterior()
    {
        $producto = Producto::where('estatus' , 1 )
                                ->where('id' , '<' , $this->id)
                                ->where('categoria_id' , $this->categoria_id)
                                ->where('id_padre' , null)
                                ->orderBy('id' , 'desc')
                                ->first();

        return $producto;
    }

    public function imagen()
    {
        $imagen = asset( 'assets/img/actualidad_riviera_3.jpg');

        // imagen web prioritaria
        if($this->imagen_web)
        {
            $imagen = asset( 'storage/productos/' . $this->imagen_web);

            return $imagen;
        }

        // si tiene imagen la muestra
        if($this->imagen)
        {
            return asset( 'storage/productos/' . $this->imagen);
        }

        return $imagen;
    }
    
    public function imagenPri()
    {
        if($this->imagen == null)
        {
            return null;
        }

        $imagen = asset( 'storage/productos/' . $this->imagen);

        return $imagen;
    }
    
    public function ficha()
    {
        if($this->ficha == null)
        {
            return null;
        }

        $imagen = asset( 'storage/productos/' . $this->ficha);

        return $imagen;
    }
    
    public function imagenWeb()
    {
        $imagen = asset( 'storage/productos/' . $this->imagen_web);

        return $imagen;
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class , 'categoria_id');
    }

    public function categoriaNombre()
    {
        if($this->categoria)
        {
            return $this->categoria->nombre;
        }

        return null;
    }
    
    public function subCategoria()
    {
        return $this->belongsTo(Categoria::class , 'subcategoria_id');
    }

    public function subProductos()
    {
        return Producto::where(function($query){
                $query->where('id_padre', $this->id)
                        ->orWhere('id_padre', $this->id_producto);
            })->where('estatus', 1)
            ->get();
    }

    public function marca()
    {
        return $this->belongsTo(Categoria::class , 'marca_id');
    }

    public function impuesto()
    {
        if($this->exento)
        {
            return 0;
        }
        
        return opcionSlug('impuesto');
    }
    
    public function precioImpuesto()
    {
        $impuesto = $this->precio * $this->impuesto() / 100;

        return $impuesto;
    }

    public function ventas()
    { 
        return $this->hasMany(OrdenItem::class , 'producto_id');
    }
}
