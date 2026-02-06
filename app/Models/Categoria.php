<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function imagen()
    {
        $imagen = asset( 'assets/img/actualidad_riviera_3.jpg');

        if($this->imagen)
        {
            $imagen = asset( 'storage/categorias/' . $this->imagen);
        }

        return $imagen;
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

    public function catPrincipal()
    {
        if($this->padre_id == null)
        {
            return null;
        }

        $cat = Categoria::find($this->padre_id);

        if(!$cat)
        {
            return null;
        }

        return $cat->nombre;
    }

    public function subCategorias()
    {
        return $this->hasMany(Categoria::class , 'padre_id');
    }

    public function productos()
    {
        return $this->hasMany(Producto::class , 'categoria_id')->where('id_padre' , null);
    }
    
    public function productosConImagen()
    {
        return $this->hasMany(Producto::class , 'categoria_id')->where('imagen' , '!=' , null);
    }

    public function getImagenProducto()
    {
        $producto = Producto::where('categoria_id' , $this->id)
                        ->where('imagen' , '!=' , null)
                        ->inRandomOrder()
                        ->first();
        // dd($producto);
        if(!$producto)
        {
            return asset('img/peru-fondo-2.jpg');
        }

        return $producto->imagen();
    }
}
