<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Opcion;
use Livewire\WithFileUploads;

class ConfigComponent extends Component
{
    use WithFileUploads;
    public $opcion = [] , $logotipo , $logotipoAdmin , $tienda , $imagenWeb;
    

    public function mount()
    {
        $this->logotipo = asset('storage/imagenes') . '/' . opcionSlug('logotipo');
        $this->logotipoAdmin = asset('storage/imagenes') . '/' . opcionSlug('logotipo_admin');
        $this->tienda = asset('storage/imagenes') . '/' . opcionSlug('tienda');
        $this->imagenWeb = asset('storage/imagenes') . '/' . opcionSlug('imagen_web');
        $this->consultarOpciones();
    }

    public function generarToken()
    {
        $valor = \Str::random(50);
        $this->guardarOpcion('api_token' , $valor);
    }

    public function updatedLogotipo($logotipo)
    {
        $this->validate([
            'logotipo' => 'image|max:3000',
        ]);

        $nombreArchivo = md5(time()) . '.' . $this->logotipo->getClientOriginalExtension();

        $this->logotipo->storeAs('public/imagenes/' , $nombreArchivo);

        $this->guardarOpcion('logotipo' , $nombreArchivo);

        $this->logotipo = asset('storage/imagenes') . '/' . $nombreArchivo;

        $this->opcion['logotipo'] = $nombreArchivo;
    }
    
    public function updatedLogotipoAdmin($logotipoAdmin)
    {
        $this->validate([
            'logotipoAdmin' => 'image|max:3000',
        ]);

        $nombreArchivo = md5(time()) . '.' . $this->logotipoAdmin->getClientOriginalExtension();

        $this->logotipoAdmin->storeAs('public/imagenes/' , $nombreArchivo);

        $this->guardarOpcion('logotipo_admin' , $nombreArchivo);

        $this->logotipoAdmin = asset('storage/imagenes') . '/' . $nombreArchivo;

        $this->opcion['logotipo_admin'] = $nombreArchivo;
    }
    
    public function updatedTienda($tienda)
    {
        $this->validate([
            'tienda' => 'image|max:3000',
        ]);

        $nombreArchivo = md5(time()) . '.' . $this->tienda->getClientOriginalExtension();

        $this->tienda->storeAs('public/imagenes/' , $nombreArchivo);

        $this->guardarOpcion('tienda' , $nombreArchivo);

        $this->tienda = asset('storage/imagenes') . '/' . $nombreArchivo;

        $this->opcion['tienda'] = $nombreArchivo;
    }
    
    public function updatedImagenWeb($imagenWeb)
    {
        $this->validate([
            'imagenWeb' => 'image|max:3000',
        ]);

        $nombreArchivo = md5(time()) . '.' . $this->imagenWeb->getClientOriginalExtension();

        $this->imagenWeb->storeAs('public/imagenes/' , $nombreArchivo);

        $this->guardarOpcion('imagenWeb' , $nombreArchivo);

        $this->imagenWeb = asset('storage/imagenes') . '/' . $nombreArchivo;

        $this->opcion['imagen_web'] = $nombreArchivo;
    }

    public function guardarOpcion($slug , $valor)
    {
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
    }
    
    public function render()
    {
        return view('livewire.config-component');
    }

    public function consultarOpciones()
    {
        foreach(Opcion::all() as $item)
        {
            $this->opcion[$item->slug] = $item->valor;
        }
    }

    public function guardar()
    {
        foreach ($this->opcion as $key => $valor) {
            $this->guardarOpcion($key , $valor);    
        }
        
        $this->consultarOpciones();
        session()->flash('status' , 'Datos Guardados');
    }
}
