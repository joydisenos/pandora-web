<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use Livewire\WithPagination;

class BuscadorComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['buscarInput'];
    public $buscar;

    public function paginationView()
    {
        return 'includes.pagination';
    }

    public function updatingBuscar()
    {
        $this->resetPage();
    }

    public function buscarInput($input)
    {
        $this->buscar = $input;
        $this->resetPage();
    }

    public function render()
    {
        $productos = [];
        $categorias = [];

        if($this->buscar)
        {
            $productos = Producto::where(function($query){
                                        $query->where('nombre' , 'like' , '%'. $this->buscar . '%' )
                                                ->orWhere('id_producto' ,'like' , '%'. $this->buscar . '%' )
                                                ->orWhere('sku_producto' ,'like' , '%'. $this->buscar . '%' );
                                    })
                                ->where('id_padre' , null)
                                ->paginate(4);
            
            $categorias = Categoria::where('nombre' , 'like' , '%'. $this->buscar . '%' )
                                    ->limit(6)
                                    ->get();
        }
        
        $data = [
            'productos' => $productos,
            'categorias' => $categorias,
        ];

        return view('livewire.buscador-component' , $data);
    }
}
