<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;

class TiendaComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $coleccionId , $categoriaId , $subcategoriaId , $buscar , $ordenarPor , $vista , $categorias , $precioFilter , $tienda;

    protected $queryString = ['categoriaId' , 'coleccionId' , 'subcategoriaId' , 'tienda' , 'buscar'];

    public function mount()
    {
        $this->vista = 'grid';
        $this->categorias = [];
        $this->ordenarPor = 'created_at';
        // if($this->categoriaId)
        // {
        //     $this->categorias[$this->categoriaId] = true;
        // }
    }

    public function updatedCategoriaId($categoriaId)
    {
        $this->subcategoriaId = null;
    }

    public function filtrar()
    {
        return true;
    }

    public function updatingBuscar()
    {
        $this->resetPage();
    }
    
    public function updatingCategoriaId()
    {
        $this->resetPage();
    }

    public function resetFiltros()
    {
        $this->tienda = null;
        $this->precioFilter = null;
        $this->buscar = null;
        $this->categorias = [];
    }

    public function render()
    {
        $productos = new Producto();

        if($this->categoriaId)
        {
            $productos = $productos->where('categoria_id' , $this->categoriaId);
        }

        if($this->subcategoriaId)
        {
            $productos = $productos->where('subcategoria_id' , $this->subcategoriaId);
        }
        
        if( count($this->categorias) )
        $productos = $productos->where(function($query){
            foreach ($this->categorias as $key => $val) {
                if($val){
                    $query->orWhere('categoria_id', "$key");
                }
            }
        });
        
        if($this->buscar)
        {
            $productos = $productos->where(function($query){
                $query->where('nombre' , 'like' , '%'. $this->buscar . '%' )
                        ->orWhere('sku_producto' ,'like' , '%'. $this->buscar . '%' );
            });
        }
        
        if($this->precioFilter)
        {
            $productos = $productos->where('precio' , '<=' ,  $this->precioFilter  );
        }
        
        if($this->coleccionId)
        {
            $productos = $productos->where('coleccion_id' ,  $this->coleccionId  );
        }
        
        // if($this->tienda)
        // {
        //     $productos = $productos->where('tienda' , $this->tienda);
        // }

        $productos = $productos->where('estatus' , 1)
                                ->where('flag_activo' , 1 )
                                ->where('id_padre' , null)
                                ->orderBy($this->ordenarPor)
                                ->paginate(24);
                                
        $data = [
            'productos' => $productos,
        ];

        return view('livewire.tienda-component' , $data);
    }
}
