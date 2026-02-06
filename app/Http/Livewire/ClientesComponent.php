<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cliente;

class ClientesComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $buscar , $modo , $clienteId , $cliente;
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
        $clientes = new Cliente();

        if($this->buscar)
        {
            $clientes = $clientes->where('nombre' , 'like' , '%' . $this->buscar . '%')
                    ->orWhere('apellido' , 'like' , '%' . $this->buscar . '%')
                    ->orWhereRaw("CONCAT(TRIM(nombre), ' ' ,TRIM(apellido)) like ?", ["%{$this->buscar}% "])      
                    ->orWhere('cedula' , 'like' , '%' . $this->buscar . '%')
                    ->orWhere('email' , 'like' , '%' . $this->buscar . '%');
        }

        

        $clientes = $clientes->paginate(10);

        $data = [
            'clientes' => $clientes,
        ];

        return view('livewire.clientes-component' , $data);
    }

    public function edit(Cliente $cliente)
    {
        $this->cliente = $cliente->toArray();
        $this->clienteId = $cliente->id;
        $this->modo = 'edit';
    }

    public function save()
    {
        $this->validate([
            'cliente.nombre' => 'required',
            'cliente.apellido' => 'required',
            'cliente.cedula' => 'required',
            'cliente.telefono' => 'required',
            'cliente.direccion' => 'required',
            'cliente.email' => 'required|email',
        ]);

        if (!preg_match("/^[0-9-]+$/", $this->cliente['cedula'])) {
            return $this->addError('cliente.cedula', 'Sólo debe tener caracteres numéricos o guiones.');
        }

        if($this->clienteId)
        {
            $cliente = Cliente::find($this->clienteId);
            $cliente->update($this->cliente);
        }

        if(!$this->clienteId)
        {
            $cliente = Cliente::create($this->cliente);
        }

        $this->resetForm();
    }

    public function crear()
    {
        $this->cliente = [];
        $this->modo = 'edit';
    }

    public function resetForm()
    {
        $this->cliente = [];
        $this->clienteId = null;
        $this->modo = 'lista';
    }
}
