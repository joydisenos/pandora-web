<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Precio;
use App\Models\Galeria;
use Illuminate\Support\Facades\Storage;

class ProductosComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $buscar , $modo , $productoId , $categoriaId , $tienda , $producto , $imagen , $imagen_web , $ficha , $file , $variablePrecio , $stocks;
    public $subproductos = [] , $padreId;
    protected $listeners = ['buscar'];

    public function buscar($buscar)
    {
        $this->buscar = $buscar;
    }

    public function updatedFile($file)
    {
        // $productoId = $this->productoId;

        if(!$this->productoId)
        {
            $producto = $this->save($stay = true);
        }

        $nombreArchivo = 'galeria-' . md5(time()) . '.' . $file->getClientOriginalExtension();

        $this->file->storeAs('public/productos/' , $nombreArchivo);
        
        $item = Galeria::create([
            'producto_id' => $this->productoId,
            'imagen' => $nombreArchivo,
        ]);

        $this->file = null;
    }

    public function deleteGaleria(Galeria $galeria)
    {
        Storage::delete("productos/$galeria->imagen");
        $galeria->delete();
    }

    public function agregarVariablePrecio()
    {
        if(!$this->productoId)
        {
            $producto = $this->save($stay = true);
        }
        $var = Precio::create(['producto_id' => $this->productoId]);
        $varPrice = Precio::find($var->id);
        $this->variablePrecio[] = $varPrice->toArray();
        // $this->variablePrecio = findProducto($this->productoId)->variablePrecio->toArray();
    }

    public function deletePrecio($id)
    {
        Precio::find($id)->delete();
        $this->variablePrecio = findProducto($this->productoId)->variablePrecio->toArray();
    }

    public function mount()
    {
        $this->modo = 'lista';
        $this->variablePrecio = [];
    }

    public function render()
    {
        // dd($this->stocks);
        $productos = new Producto();

        if($this->buscar)
        {
            $productos = $productos->where(function($query) {
                $query->where('nombre' , 'like' , '%' . $this->buscar . '%')
                        ->orWhere('id_producto' , 'like' , "%$this->buscar%")
                        ->orWhere('sku_producto' , 'like' , "%$this->buscar%");
            });
        }
        
        if($this->categoriaId)
        {
            $productos = $productos->where('categoria_id' , $this->categoriaId);
        }
        
        if($this->tienda)
        {
            $productos = $productos->where('tienda' , $this->tienda);
        }

        $productos = $productos->where('id_padre' , null)
                                ->paginate(10);

        if($this->productoId && $this->modo == 'edit' && !$this->padreId){
            $productoRef = Producto::find($this->productoId);
            $this->subproductos = Producto::where('id_padre', $this->productoId)->orWhere('id_padre' , $productoRef->id_producto)->get();
        }

        $data = [
            'productos' => $productos,
        ];

        return view('livewire.productos-component' , $data);
    }

    public function subcategorias()
    {
        if( isset($this->producto['categoria_id']) && $this->producto['categoria_id'])
        {
            return Categoria::where('padre_id' , $this->producto['categoria_id'])->get();
        }else{
            return [];
        }
    }

    public function crearSubproducto()
    {
        $this->padreId = $this->productoId;
        $this->productoId = null;
        $this->producto = [];
        $this->producto['id_padre'] = $this->padreId;
        $this->variablePrecio = [];
        $this->stocks = [];
        $this->imagen = null;
        $this->imagen_web = null;
        $this->ficha = null;
    }

    public function volver()
    {
        if($this->padreId){
            $this->edit(Producto::find($this->padreId));
            $this->padreId = null;
        }else{
            $this->resetForm();
        }
    }

    public function edit(Producto $producto)
    {
        $this->producto = $producto->toArray();
        $this->productoId = $producto->id;
        $this->variablePrecio = $producto->variablePrecio->toArray();
        $this->imagen = $producto->imagenPri();
        $this->imagen_web = $producto->imagenWeb();
        $this->ficha = $producto->ficha();
        $this->stocks = [];
        foreach($producto->stockTienda as $stock)
        {
            $this->stocks[$stock->tienda_id] = $stock->stock;
        }
        $this->modo = 'edit';
    }
    
    public function editSubproducto($id)
    {
        $this->padreId = $this->productoId;
        $this->edit(Producto::find($id));
    }
    
    public function delete(Producto $producto)
    {
        $producto->delete();
    }

    public function save($stay = null)
    {
        $this->validate([
            'producto.nombre' => 'required',
            // 'producto.precio' => 'required', 
        ]);
        
        if($this->imagen && is_file($this->imagen))
        {
            $this->saveArchivo('public/productos/' , 'imagen');
        }

        if($this->imagen_web && is_file($this->imagen_web))
        {
            $this->saveArchivo('public/productos/' , 'imagen_web');
        }

        if($this->ficha && is_file($this->ficha))
        {
            $this->saveArchivo('public/productos/' , 'ficha');
        }

        if($this->productoId)
        {
            $producto = Producto::find($this->productoId);
            $producto->update($this->producto);
        }

        if(!$this->productoId)
        {
            $producto = Producto::create($this->producto);
        }
            if(config('parts.precioVariable')){
                $producto->syncPrecios($this->variablePrecio);
            }
            if(config('parts.multiTienda')){
                $producto->syncStocks($this->stocks);
            }

        if($this->padreId){
             $this->edit(findProducto($this->padreId));
             $this->padreId = null;
             return;
        }

        if(!$stay)
        {
            $this->resetForm();
        }

        if($stay)
        {
            $this->edit(findProducto($producto->id));
        }
    }

    public function saveArchivo($ruta , $campo)
    {  
        $nombreArchivo = md5(time()) . $campo . '.' . $this->$campo->getClientOriginalExtension();

        $this->$campo->storeAs($ruta , $nombreArchivo);
        $this->producto[$campo] = $nombreArchivo;
    }

    public function crear()
    {
        $this->producto = [];
        $this->modo = 'edit';
    }

    public function resetForm()
    {
        $this->producto = [];
        $this->stocks = [];
        $this->productoId = null;
        $this->padreId = null;
        $this->imagen = null;
        $this->modo = 'lista';
    }

    public function cambiarEstatus(Producto $producto)
    {
        $producto->estatus = $producto->estatus == 1 ? 0 : 1;
        $producto->save();
    }
    
    public function verSlider(Producto $producto)
    {
        $producto->slider = $producto->slider == 1 ? 0 : 1;
        $producto->save();
    }
}
