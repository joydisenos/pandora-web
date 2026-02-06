<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function imagen()
    {
        $imagen = asset( 'storage/sliders/' . $this->imagen);

        if(!$this->imagen)
        {
            $imagen = asset('img/logo.png');
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
    
    public function tipo()
    {
        switch ($this->tipo) {
            case 1:
                $out="Principal";
                break;
            case 2:
                $out="Logos";
                break;
            
            default:
                $out="No definido";
                break;
        }

        return $out;
    }
}
