<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comentario;

class ComentarComponent extends Component
{
    public $productoId , $comentario;

    public function mount($productoId)
    {
        $this->productoId = $productoId;
    }

    public function render()
    {
        return view('livewire.comentar-component');
    }

    public function comentar()
    {
        $this->validate([
            'comentario.puntos' => 'required',
            'comentario.titulo' => 'required',
            'comentario.comentario' => 'required',
        ]);

        $this->comentario['user_id'] = auth()->user()->id;
        $this->comentario['producto_id'] = $this->productoId;
        $this->comentario['nombre'] = auth()->user()->nombreCompleto();

        Comentario::create($this->comentario);

        session()->flash('mensaje' , 'Comentario Enviado!');
        $this->comentario = [];
    }
}
