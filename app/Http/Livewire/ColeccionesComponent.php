<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Coleccion;
use App\Models\Producto;

class ColeccionesComponent extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $buscar , $modo , $coleccionId , $coleccion , $imagen;
    protected $listeners = ['buscar'];

    public function buscar($buscar)
    {
        $this->buscar = $buscar;
    }

    public function mount()
    {
        $this->modo = 'lista';
    }

    public function render()
    {
        $colecciones = new Coleccion();

        if($this->buscar)
        {
            $colecciones = $colecciones->where('nombre' , 'like' , '%' . $this->buscar . '%');
        }

        $colecciones = $colecciones->paginate(10);

        $data = [
            'colecciones' => $colecciones,
        ];

        return view('livewire.colecciones-component' , $data);
    }

    public function edit(Coleccion $coleccion)
    {
        $this->coleccion = $coleccion->toArray();
        $this->coleccionId = $coleccion->id;
        $this->imagen = $coleccion->imagen();
        $this->modo = 'edit';
    }

    public function delete(Coleccion $coleccion)
    {
        Producto::where('coleccion_id' , $coleccion->id)->update(['coleccion_id' => null]);

        $coleccion->delete();
    }

    public function save()
    {
        $this->validate([
            'coleccion.nombre' => 'required'
        ]);

        if($this->imagen && is_file($this->imagen))
        {
            $this->saveArchivo('public/colecciones/' , 'imagen');
        }

        if($this->coleccionId)
        {
            $coleccion = Coleccion::find($this->coleccionId);
            $coleccion->update($this->coleccion);
        }

        if(!$this->coleccionId)
        {
            $coleccion = Coleccion::create($this->coleccion);
        }

        $this->resetForm();
    }

    public function saveArchivo($ruta , $campo)
    {   
        $nombreArchivo = md5(time()) . '.' . $this->$campo->getClientOriginalExtension();

        $this->$campo->storeAs($ruta , $nombreArchivo);
        $this->coleccion[$campo] = $nombreArchivo;
    }

    public function crear()
    {
        $this->coleccion = [];
        $this->modo = 'edit';
    }

    public function resetForm()
    {
        $this->coleccion = [];
        $this->coleccionId = null;
        $this->imagen = null;
        $this->modo = 'lista';
    }

    public function cambiarEstatus(Coleccion $coleccion)
    {
        $coleccion->estatus = $coleccion->estatus == 1 ? 0 : 1;
        $coleccion->save();
    }
}
