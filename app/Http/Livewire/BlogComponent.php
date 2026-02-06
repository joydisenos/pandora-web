<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;

class BlogComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $queryString = ['buscar'];

    public  $buscar;

    public function render()
    {
        $posts = new Post();
        
        if($this->buscar)
        {
            $posts = $posts->where(function($query){
                $query->where('nombre', 'like', '%' . $this->buscar . '%')
                        ->orWhere('tags' , 'like', '%' . $this->buscar . '%')
                        ->orWhere('contenido', 'like', '%' . $this->buscar . '%')
                        ->orWhere('descripcion', 'like', '%' . $this->buscar . '%');

            });
        }

        $posts = $posts->orderBy('created_at' , 'desc')->paginate(8);

        $data = [
            'posts' => $posts
        ];

        return view('livewire.blog-component' , $data);
    }
}
