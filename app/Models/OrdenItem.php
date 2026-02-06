<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function orden()
    {
        return $this->belongsTo(Orden::class , 'orden_id');
    }

    public function total()
    {
        return $this->precio * $this->cantidad;
    }

    public function impuesto()
    {
        return round(($this->total() * $this->impuesto) / 100 , 2);
    }

    public function totalImpuesto()
    {
        return round($this->total() + $this->impuesto() , 2);
    }
}
