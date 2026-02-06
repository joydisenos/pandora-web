<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Slider;

class SlidersComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $buscar , $modo , $tipo , $slider , $sliderId , $imagen;
    protected $listeners = ['buscar'];

    public function buscar($buscar)
    {
        $this->buscar = $buscar;
    }

    public function mount()
    {
        $this->modo = 'lista';
        $this->tipo = 1;
        $this->slider = ['tipo' => $this->tipo];
    }

    public function render()
    {
        $sliders = new Slider();

        if($this->buscar)
        {
            $sliders = $sliders->where('descripcion' , 'like' , '%' . $this->buscar . '%');
        }
        
        if($this->tipo)
        {
            $sliders = $sliders->where('tipo' , $this->tipo );
        }

        $sliders = $sliders->paginate(10);

        $data = [
            'sliders' => $sliders,
        ];
        
        return view('livewire.sliders-component' , $data);
    }

    public function save()
    {
        if($this->imagen && is_file($this->imagen))
        {
            $this->saveArchivo('public/sliders/' , 'imagen');
        }

        if($this->sliderId)
        {
            $slider = Slider::find($this->sliderId);
            $slider->update($this->slider);
        }

        if(!$this->sliderId)
        {
            $slider = Slider::create($this->slider);
        }

        $this->resetForm();
    }

    public function saveArchivo($ruta , $campo)
    {   
        $nombreArchivo = md5(time()) . '.' . $this->$campo->getClientOriginalExtension();

        $this->$campo->storeAs($ruta , $nombreArchivo);
        $this->slider[$campo] = $nombreArchivo;
    }

    public function edit(Slider $slider)
    {
        $this->slider = $slider->toArray();
        $this->sliderId = $slider->id;
        $this->imagen = $slider->imagen();
        $this->modo = 'edit';
    }

    public function delete(Slider $slider)
    {
        $slider->delete();
    }

    public function crear()
    {
        // $this->slider = [];
        $this->slider['tipo'] = $this->tipo;
        $this->modo = 'edit';
    }

    public function resetForm()
    {
        $this->slider = [];
        $this->sliderId = null;
        $this->imagen = null;
        $this->modo = 'lista';
    }

    public function cambiarEstatus(Slider $slider)
    {
        $slider->estatus = $slider->estatus == 1 ? 0 : 1;
        $slider->save();
    }

}
