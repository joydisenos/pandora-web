<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Favorito;
use Livewire\WithPagination;

class FavoritosComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $data = [
            'favoritos' => Favorito::where('user_id' , auth()->user()->id)->paginate(20)
        ];

        return view('livewire.favoritos-component' , $data);
    }

    public function delete(Favorito $favorito)
    {
        $favorito->delete();
    }
}
