<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function producto()
    {
        $producto = Producto::find($this->producto_id);

        if(!$producto)
        {
            return null;
        }

        return $producto->nombre;
    }

    public function estatus()
    {
        switch ($this->estatus) {
            case 0:
                $out = 'Por aprobar';
                break;
            case 1:
                $out = 'Público';
                break;
            
            default:
                $out = 'No definido';
                break;
        }

        return $out;
    }
}
