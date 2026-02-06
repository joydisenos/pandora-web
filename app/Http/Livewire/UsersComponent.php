<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UsersComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $buscar , $modo , $userId , $user, $rol;
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
        $users = new User();

        if($this->buscar)
        {
            $users = $users->where('name' , 'like' , '%' . $this->buscar . '%')
                    ->orWhere('email' , 'like' , '%' . $this->buscar . '%');
        }

        $users = $users->paginate(10);

        $data = [
            'users' => $users,
        ];

        return view('livewire.users-component' , $data);
    }

    public function edit(User $user)
    {
        $this->user = $user->toArray();
        $this->userId = $user->id;
        $this->rol = $user->getRoleNames()->first();
        $this->modo = 'edit';
    }

    public function delete(User $user)
    {
        $user->delete();
    }

    public function save()
    {
        $this->validate([
            'user.name' => 'required',
            'user.apellido' => 'required',
            // 'user.cedula' => 'required',
            // 'user.telefono' => 'required',
            // 'user.direccion' => 'required',
            'user.email' => 'required',
        ]);

        if(isset($this->user['password']))
        {
            $this->user['password'] = bcrypt($this->user['password']);
        }

        if($this->userId)
        {
            $user = User::find($this->userId);
            $user->update($this->user);
        }

        if(!$this->userId)
        {
            $user = User::create($this->user);
        }

        $user->syncRoles([$this->rol]);

        $this->resetForm();
    }

    public function crear()
    {
        $this->user = [];
        $this->modo = 'edit';
    }

    public function resetForm()
    {
        $this->user = [];
        $this->userId = null;
        $this->rol = null;
        $this->modo = 'lista';
    }
}
