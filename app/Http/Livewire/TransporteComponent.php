<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Transporte;

class TransporteComponent extends Component
{
    public $transporte , $transporteId , $ubicacionId , $modo;

    public function mount($ubicacionId)
    {
        $this->ubicacionId = $ubicacionId;
        $this->modo = 'lista';
    }

    public function edit($id)
    {
        $transporte = Transporte::find($id);
        $this->transporteId = $id;
        $this->transporte = $transporte->toArray();
        $this->modo = 'edit';
    }

    public function delete($id)
    {
        $transporte = Transporte::find($id);
        $transporte->delete();
    }
    
    public function render()
    {
        $transportes = Transporte::where('estatus' , 1)
                                    ->where('ubicacion_id' , $this->ubicacionId)
                                    ->orderBy('tipo')
                                    ->orderBy('nombre')
                                    ->get();

        $data = [
            'transportes' => $transportes,
        ];

        return view('livewire.transporte-component' , $data);
    }

    public function save()
    {
        $this->validate([
            'transporte.nombre' => 'required',
            'transporte.tipo' => 'required',
            'transporte.precio' => 'required',
        ]);

        if($this->transporteId)
        {
            $transporte = Transporte::find($this->transporteId);
            $transporte->update($this->transporte);
        }else{
            $this->transporte['ubicacion_id'] = $this->ubicacionId;
            $transporte = Transporte::create($this->transporte);
        }

        $this->resetForm();
    }

    public function resetForm()
    {
        $this->transporteId = null;
        $this->transporte = [];
        $this->modo = 'lista';
    }
}
