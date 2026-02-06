<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transporte extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tipo()
    {
        switch ($this->tipo) {
            case 2:
                $out = 'Delivery';
                break;
            case 3:
                $out = 'Encomienda';
                break;
            
            default:
                $out = 'No Definido';
                break;
        }

        return $out;
    }
}
