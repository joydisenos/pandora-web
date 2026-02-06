<?php

namespace App\Imports;

use App\Models\Producto;
use App\Models\Categoria;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $cat = Categoria::where('nombre' , $row[0])->first();
        if(!$cat && $row[0])
        {
            $cat = Categoria::create(['nombre' => $row[0]]);
        }

        return new Producto([
            'id_producto' => $row[3],
            'imagen' => $row[3] ? $row[3] . '.jpg' : null,
            'nombre' => $row[4] ? $row[4] : 'no asignado',
            'categoria_id' => $cat ? $cat->id : null,
            'descripcion' => $row[1],
            // 'detalles' => $row[3],
            'precio' => $row[7] ? $row[7] : 0,
            'disponible' => $row[8] ? $row[8] : 0,
            'existencia' => $row[6] ? $row[6] : 0,
        ]);
    }
}
