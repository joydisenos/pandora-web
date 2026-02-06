<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comentario;
use App\Models\Reserva;

class PanelComponent extends Component
{
    public $vista, $user , $puntos , $comentario , $reserva;

    protected $queryString = ['vista'];

    public function mount()
    {
        $this->user = auth()->user()->toArray();
        if($this->vista == null)
        {
            $this->vista = 'datos';
        }
    }

    public function render()
    {
        return view('livewire.panel-component');
    }

    public function guardarPerfil()
    {
        if(isset($this->user['cedula']))
        {
            if (!preg_match("/^[0-9-]+$/", $this->user['cedula'])) {
                return $this->addError('user.cedula', 'Sólo debe tener caracteres numéricos o guiones.');
            }
        }
        if(isset($this->user['password']))
        {
            $this->user['password'] = bcrypt($this->user['password']);
        }

        $user = auth()->user();
        $user->update($this->user);

        session()->flash('status' , 'Datos Guardados!');
    }

    public function verReserva(Reserva $reserva)
    {
        $this->reserva = $reserva;
        $this->vista = 'verReserva';
    }

    public function publicarComentario()
    {
        $this->validate([
            'puntos' => 'required|numeric|min:1',
            'comentario' => 'required|min:10',
        ]);

        Comentario::create([
            'user_id' => auth()->user()->id,
            'nombre' => auth()->user()->nombreCompleto(),
            'puntos' => $this->puntos,
            'comentario' => $this->comentario,
        ]);

        $this->puntos = null;
        $this->comentario = null;

        session()->flash('status' , 'Gracias por su comentario!');
    }
}
