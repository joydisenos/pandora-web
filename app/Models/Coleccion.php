<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coleccion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function imagen()
    {
        $imagen = asset( 'storage/colecciones/' . $this->imagen);

        return $imagen;
    }

    public function productos()
    {
        return $this->hasMany(Producto::class , 'coleccion_id')->where('id_padre' , null);
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
}
