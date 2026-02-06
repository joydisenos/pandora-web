<?php

namespace App\Http\Livewire;
use App\Models\Orden;

use Livewire\Component;

class PedidosComponent extends OrdenesComponent
{
    public function render()
    {
        $ordens = new Orden();

        if($this->buscar)
        {
            $ordens = $ordens->where(function($query){
                $query->where('nombre' , 'like' , '%' . $this->buscar . '%')
                ->orWhere('apellido' , 'like' , '%' . $this->buscar . '%')
                ->orWhereRaw("CONCAT(TRIM(nombre), ' ' ,TRIM(apellido)) like ?", ["%{$this->buscar}% "])      
                ->orWhere('cedula' , 'like' , '%' . $this->buscar . '%')
                ->orWhere('id' , 'like' , '%' . $this->buscar . '%')
                ->orWhere('email' , 'like' , '%' . $this->buscar . '%');
            });
        }

        if($this->estatus != null && $this->estatus != '')
        {
            $ordens = $ordens->where('estatus' , $this->estatus);
        }

        $ordens = $ordens->orderBy('id' , 'desc')
                            ->where('estatus' , 2)
                            ->paginate(10);

        $data = [
            'ordens' => $ordens,
        ];

        return view('livewire.ordenes-component' , $data);
    }
}
