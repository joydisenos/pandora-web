<?php

namespace App\Services;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ProductImportService
{
    public function import(array $productos)
    {
        // Obtener columnas válidas para filtrar
        $productoColumns = Schema::getColumnListing('productos');
        $categoriaColumns = Schema::getColumnListing('categorias');

        foreach ($productos as $data) {
            $categoriaId = null;
            $subcategoriaId = null;

            // 1. Manejar Categoría
            if (isset($data['categoria']) && !empty($data['categoria'])) {
                $catName = $data['categoria'];
                // Filtrar datos para categoría si hay propiedades extra en el array que coincidan con columnas de categoria
                $catData = array_intersect_key($data, array_flip($categoriaColumns));
                $catData['nombre'] = $catName;
                // Asegurar que no se intente insertar el ID si viene en el array, queremos que sea autoincremental o búsqueda
                unset($catData['id']); 
                
                // Buscar o crear categoría padre
                $categoria = Categoria::firstOrCreate(
                    ['nombre' => $catName, 'padre_id' => null], // Buscamos por nombre y que sea padre (padre_id null)
                    $catData
                );
                $categoriaId = $categoria->id;
            }

            // 2. Manejar Subcategoría
            if (isset($data['subcategoria']) && !empty($data['subcategoria']) && $categoriaId) {
                $subName = $data['subcategoria'];
                $subData = array_intersect_key($data, array_flip($categoriaColumns));
                $subData['nombre'] = $subName;
                $subData['padre_id'] = $categoriaId;
                unset($subData['id']);

                $subcategoria = Categoria::firstOrCreate(
                    ['nombre' => $subName, 'padre_id' => $categoriaId],
                    $subData
                );
                $subcategoriaId = $subcategoria->id;
            }

            // 3. Preparar datos del Producto
            $productData = array_intersect_key($data, array_flip($productoColumns));
            
            // Asignar IDs de categorías
            if ($categoriaId) {
                $productData['categoria_id'] = $categoriaId;
            }
            if ($subcategoriaId) {
                $productData['subcategoria_id'] = $subcategoriaId;
            }

            // Crear Producto
            Producto::create($productData);
        }
    }
}
