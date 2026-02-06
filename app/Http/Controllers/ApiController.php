<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\ApiLog;
use Illuminate\Support\Str;
use App\Models\Orden;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductosImport;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ApiController extends Controller
{
    public function cargarProductos (Request $request)
    {
        if($request->api_key != opcionSlug('api_token'))
        {
            return 'error de token';
        }

        // Posteo
        // {
        //     'id_producto ' : '4524566',
        //     'nombre_producto ' : 'Nombre del producto',
        //     'imagen ' : 'Ruta a la imagen o el archivo en formato binario (aqui deben especificarme como lo pueden enviar)',
        //     'descripcion' : 'Descripcion del producto(opcionalmente en html no limitativo)',
        //     'detalles' : 'Detalles específicos / técnicos o información ampliada del producto',
        //     'precio' : '21.45',
        //     'stock' : '120',
        //     'imagenes': [
        //         {
        //             'imagen_full' : 'Ruta a la imagen o el archivo en formato binario',
        //             'imagen_baja' : 'Ruta a la imagen o el archivo en formato binario',
        //         }
        //     ],
        // }
        
        // Get Content
        $productos = json_decode($request->getContent());
        
        $prodNum = 0;

        if($productos)
        {
            // $productos = json_decode($request->productos);

            // dd($productos);
            // ApiLog::create([
            //     'main' => $request->getContent()
            // ]);

            foreach($productos as $prod)
            {
                
                if($prod->id_producto)
                {
                    $producto = Producto::where('id_producto' , $prod->id_producto)->first();

                    $data = [
                        'id_producto' => $prod->id_producto,
                        // 'id_padre' => $this->detectarPadre($prod->id_producto),
                        'id_padre' => $prod->id_padre,
                        'nombre' => $prod->nombre,
                        'descripcion' => $prod->descripcion,
                        'detalles' => $prod->detalles,
                        'precio' => $prod->precio,
                        'disponible' => $prod->stock,
                    ];
                    
                    if(isset($prod->exento))
                    {
                        $data['exento'] = $prod->exento;
                    }
                    if(isset($prod->sku_producto))
                    {
                        $data['sku_producto'] = $prod->sku_producto;
                    }
                    if(isset($prod->stock_tienda))
                    {
                        $data['stock_tienda'] = json_encode($prod->stock_tienda);
                    }

                    if(isset($prod->tienda))
                    {
                        $data['tienda'] = $this->seleccionarTienda($prod->tienda);
                    }
                    
                    if(isset($prod->id_tipo_articulo))
                    {
                        $data['id_tipo_articulo'] = $prod->id_tipo_articulo;
                    }
                    
                    // Se duplica por si se envia de alguna de las dos maneras
                    if(isset($prod->idTipoArticulo))
                    {
                        $data['id_tipo_articulo'] = $prod->idTipoArticulo;
                    }
                    
                    if(isset($prod->flag_activo))
                    {
                        $data['flag_activo'] = $prod->flag_activo;
                    }
                    
                    if(isset($prod->cubicaje_x))
                    {
                        $data['cubicaje_x'] = $prod->cubicaje_x;
                    }
                    
                    if(isset($prod->cubicaje_y))
                    {
                        $data['cubicaje_y'] = $prod->cubicaje_y;
                    }

                    if(isset($prod->cubicaje_z))
                    {
                        $data['cubicaje_z'] = $prod->cubicaje_z;
                    }
                    
                    if(isset($prod->cubicajeX))
                    {
                        $data['cubicaje_x'] = $prod->cubicajeX;
                    }
                    
                    if(isset($prod->cubicajeY))
                    {
                        $data['cubicaje_y'] = $prod->cubicajeY;
                    }

                    if(isset($prod->cubicajeZ))
                    {
                        $data['cubicaje_z'] = $prod->cubicajeZ;
                    }
                    
                    if(isset($prod->peso))
                    {
                        $data['peso'] = $prod->peso;
                    }
                    
                    if(isset($prod->categoria))
                    {
                        $data['categoria_id'] = categorizarProducto($prod->categoria);
                    }
                    
                    if(isset($prod->sub_categoria))
                    {
                        $data['subcategoria_id'] = categorizarProducto($prod->sub_categoria);
                    }
                    
                    if(isset($prod->marca))
                    {
                        $data['marca_id'] = categorizarProducto($prod->marca);
                    }
                    
                    if(isset($prod->garantia))
                    {
                        $data['garantia'] = $prod->garantia;
                    }
                    
                    if(isset($prod->color))
                    {
                        $data['color'] = $prod->color;
                    }
                    
                    if(isset($prod->talla))
                    {
                        $data['talla'] = $prod->talla;
                    }


                    
                    if(isset($prod->imagen))
                    {
                        // Obtener los datos de la imagen
                        $img = $this->getB64Image($prod->imagen);
                        // Obtener la extensión de la Imagen
                        $img_extension = $this->getB64Extension($prod->imagen);
                        // Crear un nombre aleatorio para la imagen
                        $img_name = $prod->id_producto . '' . time() . '.' . $img_extension;   
                        // Usando el Storage guardar en el disco creado anteriormente y pasandole a 
                        // la función "put" el nombre de la imagen y los datos de la imagen como 
                        // segundo parametro
                        Storage::put( 'public/productos/' . $img_name, $img);
                        $data['imagen'] = $img_name;
                    }
                    
                    if(!$producto)
                    {
                        // $data = [
                        //             'id_producto' => $prod->id_producto,
                        //             // 'id_padre' => $this->detectarPadre($prod->id_producto),
                        //             'id_padre' => $prod->id_padre,
                        //             'nombre' => $prod->nombre,
                        //             'descripcion' => $prod->descripcion,
                        //             'detalles' => $prod->detalles,
                        //             'precio' => $prod->precio,
                        //             'disponible' => $prod->stock,
                        //         ];
                        
                        // if(isset($prod->sku_producto))
                        // {
                        //     $data['sku_producto'] = $prod->sku_producto;
                        // }
                        // if(isset($prod->stock_tienda))
                        // {
                        //     $data['stock_tienda'] = json_encode($prod->stock_tienda);
                        // }

                        // if(isset($producto->tienda))
                        // {
                        //     $data['tienda'] = $this->seleccionarTienda($producto->tienda);
                        // }


                        
                        // if(isset($prod->imagen))
                        // {
                        //     // Obtener los datos de la imagen
                        //     $img = $this->getB64Image($prod->imagen);
                        //     // Obtener la extensión de la Imagen
                        //     $img_extension = $this->getB64Extension($prod->imagen);
                        //     // Crear un nombre aleatorio para la imagen
                        //     $img_name = $prod->id_producto . '' . time() . '.' . $img_extension;   
                        //     // Usando el Storage guardar en el disco creado anteriormente y pasandole a 
                        //     // la función "put" el nombre de la imagen y los datos de la imagen como 
                        //     // segundo parametro
                        //     Storage::put( 'public/productos/' . $img_name, $img);
                        //     $data['imagen'] = $img_name;
                        // }

                        $producto = Producto::create($data);
                    }

                    if($producto)
                    {
                        // $data = [
                        //             'nombre' => $prod->nombre,
                        //             // 'id_padre' => $this->detectarPadre($prod->id_producto),
                        //             'id_padre' => $prod->id_padre,
                        //             'descripcion' => $prod->descripcion,
                        //             'detalles' => $prod->detalles,
                        //             'precio' => $prod->precio,
                        //             'disponible' => $prod->stock,
                        //         ];

                        // if(isset($prod->sku_producto))
                        // {
                        //     $data['sku_producto'] = $prod->sku_producto;
                        // }
                        // if(isset($prod->stock_tienda))
                        // {
                        //     $data['stock_tienda'] = json_encode($prod->stock_tienda);
                        // }
                        // if(isset($prod->tienda))
                        // {
                        //     $data['tienda'] = $this->seleccionarTienda($prod->tienda);
                        // }
                        
                        // if(isset($prod->imagen))
                        // {
                        //     // Obtener los datos de la imagen
                        //     $img = $this->getB64Image($prod->imagen);
                        //     // Obtener la extensión de la Imagen
                        //     $img_extension = $this->getB64Extension($prod->imagen);
                        //     // Crear un nombre aleatorio para la imagen
                        //     $img_name = $prod->id_producto . '' . time() . '.' . $img_extension;   
                        //     // Usando el Storage guardar en el disco creado anteriormente y pasandole a 
                        //     // la función "put" el nombre de la imagen y los datos de la imagen como 
                        //     // segundo parametro
                        //     Storage::put( 'public/productos/' . $img_name, $img);
                        //     $data['imagen'] = $img_name;
                        // }
                                
                        $producto = $producto->update($data);
                    }

                    if(isset($prod->precioCantidad) && is_array($prod->precioCantidad))
                    {
                        $arrayPrecios = [];
                        $producto = Producto::where('id_producto' , $prod->id_producto)->first();

                        foreach ($prod->precioCantidad as $key => $value)
                        {
                            $arrayPrecios[] = [
                                'id' =>  0,
                                'producto_id' =>  $producto->id,
                                'cantidad' =>  $value->cantidad,
                                'precio' => $value->precio,
                            ];
                        }
                        $producto->syncPrecios($arrayPrecios);
                    }
                    

                    $datalog = $data;
                    // $datalog['id_padre_api'] = $prod->id_padre;
                    unset($datalog['imagen']);

                    ApiLog::create([
                            'main' => json_encode($datalog)
                    ]);

                    $prodNum ++;
                }
            }
        }

        return 'Productos registrados: ' . $prodNum;
    }

    public function crearOrden(Request $request)
    {
        if($request->api_key != opcionSlug('api_token'))
        {
            return 'error de token';
        }

        $orden = json_decode($request->getContent() , true);

        ApiLog::create([
                'main' => $request->getContent()
        ]);

        $ordenCreada = Orden::create($orden);

        if(isset($orden['items']) && is_array($orden['items']))
        {
            $ordenCreada->syncItems($orden['items']);
        }

        if(!$ordenCreada)
        {
            return 'no se pudo realizar la operación';
        }

        return 'orden #'. $ordenCreada->id .' creada';
    }

    public function detectarPadre($idProducto)
    {
        $array = explode('-' , $idProducto);
        
        if(count($array) == 1)
        {
            return null;
        }

        return $array[0];
    }

    public function getB64Image($base64_image)
    {
        // Obtener el String base-64 de los datos         
        $image_service_str = substr($base64_image, strpos($base64_image, ",")+1);
        // Decodificar ese string y devolver los datos de la imagen        
        $image = base64_decode($image_service_str);
        // Retornamos el string decodificado
        return $image; 
    }

    public function getB64Extension($base64_image, $full=null){  
        // Obtener mediante una expresión regular la extensión imagen y guardarla
        // en la variable "img_extension"data:image/        
        preg_match("/^data:image\/(.*);base64/i",$base64_image, $img_extension);
        // Dependiendo si se pide la extensión completa o no retornar el arreglo con
        // los datos de la extensión en la posición 0 - 1

        if(count($img_extension) == 0)
        {
            return null;
        }
        
        if(count($img_extension) == 1)
        {
            return $img_extension[0];
        }

        return ($full) ?  $img_extension[0] : $img_extension[1];  
    }

    public function seleccionarTienda($tienda)
    {
        if(is_string($tienda))
        {
            $tienda = Str::slug($tienda);
        }

        switch ($tienda) {

            // integers
            case 1:
                $out = 1;
                break;
            
            case 2:
                $out = 2;
                break;

            case 3:
                $out = 3;
                break;
            
            // string numero
            case '1':
                $out = 1;
                break;
            
            case '2':
                $out = 2;
                break;

            case '3':
                $out = 3;
                break;

            // strings
            case 'avenida-b':
                $out = 1;
                break;
           
            case 'chorrera':
                $out = 2;
                break;
                
            case '24-diciembre':
                $out = 3;
                break;
            
            default:
                $out = null;
                break;
        }

        return $out;
    }
    
    public function ordenes (Request $request)
    {
        if($request->api_key != opcionSlug('api_token'))
        {
            return 'error de token';
        }

        $desde = $request->desde ? Carbon::createFromFormat('Y-m-d' , $request->desde) : Carbon::now()->startOfMonth();
        $hasta = $request->hasta ? Carbon::createFromFormat('Y-m-d' , $request->hasta) : Carbon::now();

        $ordenes = Orden::where('created_at' , '>=' , $desde)
                            ->where('created_at' , '<=' , $hasta)
                            ->with('items')
                            ->get();

        return $ordenes;
    }

    // public function actualizarInventario()
    // {
    //     if($request->api_key != opcionSlug('api_token'))
    //     {
    //         return 'error de token';
    //     }

    //     // Posteo
    //     // {
    //     //     'id_producto ' : '4524566',
    //     //     'nombre_producto ' : 'Nombre del producto',
    //     //     'imagen ' : 'Ruta a la imagen o el archivo en formato binario (aqui deben especificarme como lo pueden enviar)',
    //     //     'descripcion' : 'Descripcion del producto(opcionalmente en html no limitativo)',
    //     //     'detalles' : 'Detalles específicos / técnicos o información ampliada del producto',
    //     //     'precio' : '21.45',
    //     //     'stock' : '120',
    //     //     'imagenes': [
    //     //         {
    //     //             'imagen_full' : 'Ruta a la imagen o el archivo en formato binario',
    //     //             'imagen_baja' : 'Ruta a la imagen o el archivo en formato binario',
    //     //         }
    //     //     ],
    //     // }
        
    //     // Get Content
    //     // $request->getContent();
    //     $prod = 0;
    //     if($request->productos)
    //     {
    //         foreach($request->productos as $prod)
    //         {
    //             if($prod->id_producto)
    //             {
    //                 $producto = Producto::where('id_producto' , $prod->id_producto)->first();

    //                 if($producto)
    //                 {
    //                     $producto = Producto::update([
    //                         'nombre' => $prod->nombre,
    //                         'descripcion' => $prod->descripcion,
    //                         'detalles' => $prod->detalles,
    //                         'precio' => $prod->precio,
    //                         'disponible' => $prod->stock,
    //                     ]);
    //                     $prod ++;
    //                 }

    //             }
    //         }
    //     }

    //     return 'Productos actualizados: ' . $prod;
    // } 
    
    public function actualizarInventarioProducto(Request $request)
    {
        if($request->api_key != opcionSlug('api_token'))
        {
            return 'error de token';
        }

        // Get Content
        // $request->getContent();
        // $prod = 0;
        if($request->id_producto)
        {
            $producto = Producto::where('id_producto' , $request->id_producto)->first();

            if($producto)
            {
                $producto = $producto->update([
                    // 'nombre' => $request->nombre,
                    // 'descripcion' => $request->descripcion,
                    // 'detalles' => $request->detalles,
                    // 'precio' => $request->precio,
                    'disponible' => $request->stock,
                ]);
            }

            if(!$producto)
            {
                return 'Producto no registrado';
            }
        }

        return 'Producto actualizado';
    } 

    public function importExcel() 
    {
        Excel::import(new ProductosImport, public_path('storage/productos.xlsx'));
        
        return redirect('/')->with('success', 'All good!');
    }

}
