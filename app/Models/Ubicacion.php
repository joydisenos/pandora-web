<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tiendas()
    {
        return $this->hasMany(EnvioTienda::class , 'ubicacion_id');
    }

    public function tiendasArray()
    {
        $out = [];
        $tiendas = EnvioTienda::where('ubicacion_id' , $this->id)->get();

        foreach($tiendas as $tienda)
        {
            $out[] = $tienda->tienda_slug;
        }

        return $out;
    }

    public function syncTiendas(array $tiendas) 
    {
        EnvioTienda::where('ubicacion_id' , $this->id)->delete();

        foreach($tiendas as $tienda)
        {
            EnvioTienda::create([
               'ubicacion_id' => $this->id,
               'tienda_slug' => $tienda, 
            ]);
        }
    }

    public function padre()
    {
        return $this->belongsTo(Ubicacion::class , 'padre_id');
    }

    public function hijos()
    {
        return $this->hasMany(Ubicacion::class , 'padre_id');
    }

    public function ubicacionCompleta()
    {
        switch ($this->tipo) {
            case 1:
                // Provincia
                $out = $this->nombre . ' Panama';
                break;

            case 2:
                // Distrito
                $out = $this->padre->nombre . ' ' . $this->nombre . ' Panama';
                break;

            case 3:
                // Corregimiento 
                $out = $this->padre->padre->nombre . ' ' . $this->padre->nombre . ' ' . $this->nombre . ' Panama';
                break;

            case 4:
                // Barrio
                $out = $out = $this->padre->padre->padre->nombre . ' ' . $this->padre->padre->nombre . ' ' . $this->padre->nombre . ' ' . $this->nombre . ' Panama';
                break;
            
            default:
                $out = 'No definido';
                break;
        }

        return $out;
    }

    public function tipo()
    {
        switch ($this->tipo) {
            case 1:
                $out = 'Provincia';
                break;

            case 2:
                $out = 'Distrito';
                break;

            case 3:
                $out = 'Corregimiento';
                break;

            case 4:
                $out = 'Barrio';
                break;
            
            default:
                $out = 'No definido';
                break;
        }

        return $out;
    }
    
    public function nombreHijos()
    {
        switch ($this->tipo) {
            case 1:
                $out = 'Distritos';
                break;

            case 2:
                $out = 'Corregimientos';
                break;

            case 3:
                $out = 'Barrios';
                break;

            case 4:
                $out = 'No Definido';
                break;
            
            default:
                $out = 'No definido';
                break;
        }

        return $out;
    }
}
