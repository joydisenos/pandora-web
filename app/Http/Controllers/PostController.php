<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function posts()
    {
        return view('front.lista-posts');
    }
    
    public function verPost($slug)
    {
        $post = Post::where('slug' , $slug)
                        ->orderBy('id' , 'desc')
                        ->where('tipo' , 1)
                        ->firstOrFail();

        return view('front.post' , compact('post'));
    }
    
    public function servicios()
    {
        return view('front.lista-servicios');
    }

    public function verServicio($slug)
    {
        $post = Post::where('slug' , $slug)
                        ->orderBy('id' , 'desc')
                        ->where('tipo' , 2)
                        ->firstOrFail();

        return view('front.post-full' , compact('post'));
    }
    
    public function verAhorro($slug)
    {
        $post = Post::where('slug' , $slug)
                        ->orderBy('id' , 'desc')
                        ->where('tipo' , 4)
                        ->firstOrFail();

        return view('front.post-full' , compact('post'));
    }
    
    public function promociones()
    {
        return view('front.lista-promociones');
    }

    public function verPromocion($slug)
    {
        $post = Post::where('slug' , $slug)
                        ->orderBy('id' , 'desc')
                        ->where('tipo' , 3)
                        ->firstOrFail();

        return view('front.post-full' , compact('post'));
    }

    public function uploadImage(Request $request)
    {
        // dd($request->all());
        if ($request->hasFile('upload')) {
            $rutaImagen = 'imagenes';
            $imagen = $request->file('upload');
            $nombreImagen =  'imagen-' . md5(time()) . '.' . $request->upload->extension();
            $request->file('upload')->storeAs($rutaImagen, $nombreImagen, 'public');

            $url = asset('storage/imagenes/' . $nombreImagen); 
            $msg = 'Imagen Cargada con éxito'; 
            $img = '<img src="$url">';
            
            return json_encode(['url' => $url]);
        }else{ 
            return json_encode(['error' => 'Hubo un error de carga en la imagen']);
        } 

    }
}
