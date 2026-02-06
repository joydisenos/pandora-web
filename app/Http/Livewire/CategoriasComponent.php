<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Categoria;
use App\Models\Producto;

class CategoriasComponent extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $buscar , $modo , $categoriaId , $categoria , $imagen;
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
        $categorias = new Categoria();

        if($this->buscar)
        {
            $categorias = $categorias->where('nombre' , 'like' , '%' . $this->buscar . '%');
        }

        $categorias = $categorias->orderBy('nombre')->where('padre_id' , null)->paginate(10);

        $subcategorias = [];

        if($this->modo == 'edit' && $this->categoriaId)
        {
            $subcategorias = Categoria::where('padre_id' , $this->categoriaId)->get();
        }

        $data = [
            'categorias' => $categorias,
            'subcategorias' => $subcategorias
        ];

        return view('livewire.categorias-component' , $data);
    }

    public function edit(Categoria $categoria)
    {
        $this->categoria = $categoria->toArray();
        $this->categoriaId = $categoria->id;
        $this->imagen = $categoria->imagen();
        $this->modo = 'edit';
    }
    
    public function crearSub($categoriaId)
    {
        $this->categoria = [
            'padre_id' => $categoriaId
        ];
        $this->categoriaId = null;
        $this->modo = 'edit';
    }

    public function delete(Categoria $categoria)
    {
        Producto::where('categoria_id' , $categoria->id)->update(['categoria_id' => null]);

        $categoria->delete();
    }

    public function save()
    {
        $this->validate([
            'categoria.nombre' => 'required'
        ]);

        if($this->imagen && is_file($this->imagen))
        {
            $this->saveArchivo('public/categorias/' , 'imagen');
        }

        if($this->categoriaId)
        {
            $categoria = Categoria::find($this->categoriaId);
            $categoria->update($this->categoria);
        }

        if(!$this->categoriaId)
        {
            $categoria = Categoria::create($this->categoria);
        }

        $this->resetForm();
    }

    public function saveArchivo($ruta , $campo)
    {   
        $nombreArchivo = md5(time()) . '.' . $this->$campo->getClientOriginalExtension();

        $this->$campo->storeAs($ruta , $nombreArchivo);
        $this->categoria[$campo] = $nombreArchivo;
    }

    public function crear()
    {
        $this->categoria = [];
        $this->modo = 'edit';
    }

    public function resetForm()
    {
        if(isset($this->categoria['padre_id']) && $this->categoria['padre_id'])
        {
            $this->edit(Categoria::find($this->categoria['padre_id']));
            return;
        }
        $this->categoria = [];
        $this->categoriaId = null;
        $this->imagen = null;
        $this->modo = 'lista';
    }

    public function cambiarEstatus(Categoria $categoria)
    {
        $categoria->estatus = $categoria->estatus == 1 ? 0 : 1;
        $categoria->save();
    }
}
