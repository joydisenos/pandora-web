<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Comentario;

class ComentariosComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $modo , $comentario , $comentarioId;

    public function mount()
    {
        $this->modo = 'lista';
    }

    public function render()
    {
        $comentarios = Comentario::orderBy('id' , 'desc')->paginate(20);

        $data = [
            'comentarios' => $comentarios,
        ];

        return view('livewire.comentarios-component' , $data);
    }

    public function edit(Comentario $comentario)
    {
        $this->comentario = $comentario->toArray();
        $this->comentarioId = $comentario->id;
        $this->modo = 'edit';
    }

    public function save()
    {
        if($this->comentarioId)
        {
            $comentario = Comentario::find($this->comentarioId);
            $comentario->update($this->comentario);
        }

        if(!$this->comentarioId)
        {
            $comentario = Comentario::create($this->comentario);
        }

        $this->resetForm();
    }

    public function resetForm()
    {
        $this->comentario = [];
        $this->comentarioId = null;
        $this->modo = 'lista';
    }

    public function cambiarEstatus(Comentario $comentario)
    {
        $comentario->estatus = $comentario->estatus == 1 ? 0 : 1;
        $comentario->save();
    }
    
    public function delete(Comentario $comentario)
    {
        $comentario->delete();
    }
}
