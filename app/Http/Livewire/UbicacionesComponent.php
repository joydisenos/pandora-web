<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Ubicacion;
use App\Models\Opcion;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class UbicacionesComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['buscar'];
    
    public $ubicacion,
            $ubicacionId, 
            $imagen,
            $buscar,
            $producto,
            $tiendas,
            $tipo,
            $envioGratis,
            $servicio,
            $modo = 'lista';

    public function mount()
    {
        $envioOpt = opcionSlug('envioGratis');
        $envio = $envioOpt ? $envioOpt : 0;
        
        $this->tipo = 1;
        $this->tiendas = [];
        $this->envioGratis = $envio;
    }

    public function buscar($buscar)
    {
        $this->buscar = $buscar;
    }

    public function guardarOpcion($slug = 'envioGratis' , $valor = null)
    {
        if(!$valor)
        {
            $valor = $this->envioGratis;
        }

        $opcion = Opcion::where('slug' , $slug)->first();
            if(!$opcion)
            {
                $opcion = Opcion::create([
                    // 'nombre' => $key,
                    'slug' => $slug,
                    'valor' => $valor,
                ]);
            }else{
                $opcion->update([
                    // 'nombre' => $key,
                    'slug' => $slug,
                    'valor' => $valor,
                ]);
            }

        return session()->flash('status' , 'Envío actualizado');
    }
    
    public function render()
    {
        $ubicaciones = new Ubicacion();

        if($this->buscar)
        {
            $ubicaciones = $ubicaciones->where('nombre', 'like', '%'.$this->buscar.'%');
        }
        
        if($this->tipo)
        {
            $ubicaciones = $ubicaciones->where('tipo', $this->tipo);
        }
        
        $ubicaciones = $ubicaciones->orderBy('nombre' , 'asc')->paginate(10);
        $ubicacionesPadre = new Ubicacion();
                                        // where('padre_id', null)
                                        // ->orWhere('padre_id', 0)
                                        // ->get();
        if($this->ubicacionId)
        {
            $ubicacionesPadre = $ubicacionesPadre->where('id' , '!=' , $this->ubicacionId);
        }

        $ubicacionesPadre = $ubicacionesPadre->get();

        $data = [
            'ubicaciones' => $ubicaciones,
            'ubicacionesPadre' => $ubicacionesPadre,
        ];

        return view('livewire.ubicaciones-component' , $data);
    }

    public function guardar()
    {
        $this->validate([
            'ubicacion.nombre' => 'required',
        ]);

        // Registrar ubicacion Propio
        $this->ubicacion['slug'] = Str::slug($this->ubicacion['nombre']);

        if($this->imagen && is_file($this->imagen))
        {
            $this->saveImagen();
        }
        
        if(isset($this->ubicacion['padre_id']) && $this->ubicacion['padre_id'] > 0)
        {
            $revisar = Ubicacion::find($this->ubicacion['padre_id']);
            $this->ubicacion['tipo'] = $revisar->tipo + 1;
        }else{
            $this->ubicacion['padre_id'] = null;
            $this->ubicacion['tipo'] = 1;
        }

        if($this->ubicacionId){
            $ubicacion = Ubicacion::find($this->ubicacionId);
            
            if($this->ubicacion['padre_id'] == 0)
            {
                $this->ubicacion['padre_id'] = null;
            }
            
            $ubicacion->update($this->ubicacion);
        }else{
            $ubicacion = Ubicacion::create($this->ubicacion);
        }

        $ubicacion->syncTiendas($this->tiendas);
        
        $this->resetForm();
    }

    public function agregarTienda($slug)
    {
        if(in_array($slug , $this->tiendas))
        {
            $index = array_search($slug , $this->tiendas);
            unset($this->tiendas[$index]);
            return true;
        }
        
        if(!in_array($slug , $this->tiendas))
        {
            $this->tiendas[] = $slug;
            return true;
        }

        // dd($this->tiendas);
    }

    public function resetForm()
    {
        $this->ubicacion = null;
        $this->ubicacionId = null;
        $this->imagen = null;
        $this->servicio = null;
        $this->producto = null;
        $this->tiendas = [];
        $this->modo = 'lista';
    }

    public function edit(Ubicacion $ubicacion)
    {
        $this->ubicacion = $ubicacion->toArray();
        $this->ubicacionId = $ubicacion->id;
        $this->tiendas = $ubicacion->tiendasArray();

        $this->modo = 'editar';
    }

    public function delete(Ubicacion $ubicacion)
    {
        $ubicacion->delete();
    }


    public function cambiarEstatus(ubicacion $ubicacion)
    {
        $ubicacion->estatus = $ubicacion->estatus == 1 ? 0 : 1;
        $ubicacion->save();
    }
}
