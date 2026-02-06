<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function imagen()
    {
        if(!$this->imagen)
        {
            return asset('assets/img/placeholder-img.webp');
        }

        $imagen = asset( 'storage/posts/' . $this->imagen);

        return $imagen;
    }

    public function categoria()
    {
        $categoria = Categoria::find($this->categoria_id);

        if(!$categoria)
        {
            return null;
        }
        
        return $categoria->nombre;
    }

    public function categorias()
    {
        return $this->hasMany(PostCategoria::class , 'post_id');
    }

    public function syncCategorias($categorias)
    {
        PostCategoria::where('post_id' , $this->id)->delete();
        foreach ($categorias as $catId => $value) {
            if($value)
            {
                PostCategoria::create([
                    'post_id' => $this->id,
                    'categoria_id' => $catId
                ]);
            }
        }
    }

    public function estatus()
    {
        switch ($this->estatus) {
            case 1:
                $out = 'Activo';
                break;
            
            default:
                $out = 'Oculto';
                break;
        }
        return $out;
    }
}
