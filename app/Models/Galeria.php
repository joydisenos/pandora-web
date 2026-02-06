<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function imagen()
    {
        $imagen = asset( 'storage/productos/' . $this->imagen);

        if(!$this->imagen)
        {
            $imagen = asset('img/logo.png');
        }

        return $imagen;
    }
}
