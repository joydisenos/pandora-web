<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $buscar, $modo, $postId, $post, $imagen, $file;
    protected $listeners = ['buscar' , 'actualizarContenido'];

    public function actualizarContenido($contenido)
    {
        $this->post['contenido'] = $contenido;
    }

    public function nuevoContenido()
    {
        $this->modo = 'edit';
        $this->emit('render-ck');
    }

    public function buscar($buscar)
    {
        $this->buscar = $buscar;
    }

    public function updatedFile($file)
    {
        if (!$this->postId) {
            $this->save($stay = true);
        }

        $nombreArchivo = 'post-' . md5(time()) . '.' . $file->getClientOriginalExtension();
        $this->file->storeAs('public/posts/', $nombreArchivo);

        $post = Post::find($this->postId);
        $post->imagen = $nombreArchivo;
        $post->save();

        $this->file = null;
    }

    public function deleteImagen()
    {
        $post = Post::find($this->postId);
        Storage::delete("posts/{$post->imagen}");
        $post->imagen = null;
        $post->save();
    }

    public function mount()
    {
        $this->modo = 'lista';
    }

    public function render()
    {
        $posts = new Post();

        if ($this->buscar) {
            $posts = $posts->where(function ($query) {
                $query->where('titulo', 'like', '%' . $this->buscar . '%')
                    ->orWhere('contenido', 'like', '%' . $this->buscar . '%');
            });
        }

        $posts = $posts->paginate(10);

        return view('livewire.post-component', ['posts' => $posts]);
    }

    public function edit(Post $post)
    {
        $this->post = $post->toArray();
        $this->postId = $post->id;
        $this->imagen = $post->imagen();
        $this->modo = 'edit';
        $this->emit('render-ck');
    }

    public function delete(Post $post)
    {
        Storage::delete("posts/{$post->imagen}");
        $post->delete();
    }

    public function save($stay = null)
    {
        $this->validate([
            'post.nombre' => 'required',
        ]);

        if ($this->imagen && is_file($this->imagen)) {
            $this->saveArchivo('public/posts/', 'imagen');
        }

        $this->post['slug'] = Str::slug($this->post['nombre']);

        if ($this->postId) {
            $post = Post::find($this->postId);
            $post->update($this->post);
        } else {
            $post = Post::create($this->post);
        }

        if (!$stay) {
            $this->resetForm();
        }

        if ($stay) {
            $this->edit($post);
        }
    }

    public function saveArchivo($ruta, $campo)
    {
        $nombreArchivo = md5(time()) . $campo . '.' . $this->$campo->getClientOriginalExtension();
        $this->$campo->storeAs($ruta, $nombreArchivo);
        $this->post[$campo] = $nombreArchivo;
    }

    public function crear()
    {
        $this->imagen = null;
        $this->modo = 'edit';
    }

    public function resetForm()
    {
        $this->post = [];
        $this->postId = null;
        $this->imagen = null;
        $this->modo = 'lista';
    }

    public function cambiarEstatus(Post $post)
    {
        $post->estatus = $post->estatus == 1 ? 0 : 1;
        $post->save();
    }
}

