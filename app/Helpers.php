<?php

if (! function_exists('currentUser')) {
    function currentUser()
    {
        return auth()->user();
    }
}

if (! function_exists('opcionSlug')) {
    function opcionSlug($slug)
    {
        $opcion = App\Models\Opcion::where('slug', $slug)->first();
        $valor = $opcion ? $opcion->valor : null;
        return $valor;
    }
}

if (! function_exists('ordenesMesActual')) {
    function ordenesMesActual()
    {
        $ordenes = App\Models\Orden::whereMonth('created_at' , date('m'))
                            ->whereYear('created_at' , date('Y'))
                            ->get();
        return $ordenes;
    }
}

if (! function_exists('totalOrdenesAnoActual')) {
    function totalOrdenesAnoActual()
    {
        $ordenes = App\Models\Orden::whereYear('created_at' , date('Y'))
                            ->sum('precio');
        return $ordenes;
    }
}

if (! function_exists('mesesHastaHoyArray')) {
    function mesesHastaHoyArray()
    {
        $data = [
            'Ene',
            'Feb',
            'Mar',
            'Abr',
            'May',
            'Jun',
            'Jul',
            'Ago',
            'Sep',
            'Oct',
            'Nov',
            'Dic',
        ];

        $meses = [];

        for ($i=0; $i < date('m') ; $i++) { 
            $meses[$i] = '"' . $data[$i] . '"';
        }

        $out = '[' . implode(',' , $meses) . ']';

        return $out;
    }
}

if (! function_exists('ordenesPorMesAnoActual')) {
    function ordenesPorMesAnoActual()
    {
        $totales = [];

        for ($i=0; $i < date('m') ; $i++) { 
            $totales[] = ordenesPorMes($i + 1)->sum('precio');
        }

        $out = '[' . implode(',' , $totales) . ']';

        return $out;
    }
}

if (! function_exists('ordenesPorMes')) {
    function ordenesPorMes($mes = null , $year = null)
    {
        if($mes == null)
        {
            $mes = date('m');
        }

        if($year == null)
        {
            $year = date('Y');
        }

        $ordenes = App\Models\Orden::whereMonth('created_at' , $mes)
                            ->whereYear('created_at' , $year)
                            ->get();
        return $ordenes;
    }
}

if (! function_exists('findOrden')) {
    function findOrden($id)
    {
        $orden = App\Models\Orden::find($id);
        return $orden;
    }
}

if (! function_exists('ultimasOperaciones')) {
    function ultimasOperaciones($limit = 6)
    {
        $ordenes = App\Models\Orden::orderBy('id' , 'desc')
                            ->limit($limit)
                            ->get();
        return $ordenes;
    }
}

if (! function_exists('mailsVentas')) {
    function mailsVentas()
    {
        $mails = [
            opcionSlug('email_notificacion'),
        ];
        return $mails;
    }
}



if (! function_exists('productosSlider')) {
    function productosSlider($limit = 9)
    {
        $productos = App\Models\Producto::where('slider' , 1)
                            ->where('estatus' , 1)
                            ->where('flag_activo' , 1 )
                            ->limit($limit)
                            ->get();
        return $productos;
    }
}

if (! function_exists('SliderPrincipal')) {
    function SliderPrincipal()
    {
        $sliders = App\Models\Slider::where('tipo' , 1)
                            ->where('estatus' , 1)
                            ->get();
        return $sliders;
    }
}

if (! function_exists('postsPublicos')) {
    function postsPublicos($limit = 8)
    {
        $posts = App\Models\Post::orderBy('created_at' , 'desc')
                                    ->where('tipo' , 1)
                                    ->where('estatus' , 1)
                                    ->limit($limit)
                                    ->get();

        return $posts;
    }
}

if (! function_exists('SliderLogos')) {
    function SliderLogos()
    {
        $sliders = App\Models\Slider::where('tipo' , 2)
                            ->where('estatus' , 1)
                            ->get();
        return $sliders;
    }
}

if (! function_exists('getProvincias')) {
    function getProvincias($tienda = null)
    {
        $ubicaciones = App\Models\Ubicacion::where('padre_id' , null)
                                        ->where('tipo' , 1);

        if($tienda)
        {
            $ubicaciones = $ubicaciones->whereHas('tiendas' , function($query) use($tienda){
                $query->where('tienda_slug', $tienda);
            });
        }

        $ubicaciones = $ubicaciones->get();
        return $ubicaciones;
    }
}

if (! function_exists('getDistritos')) {
    function getDistritos($provincia)
    {
        $ubicacion = App\Models\Ubicacion::where('padre_id' , null)
                                        ->where('nombre' , $provincia)
                                        ->where('tipo' , 1)
                                        ->first();
        return $ubicacion ? $ubicacion->hijos : collect([]);
    }
}

if (! function_exists('getCorregimientos')) {
    function getCorregimientos($distrito)
    {
        $ubicacion = App\Models\Ubicacion::where('nombre' , $distrito)
                                        ->where('tipo' , 2)
                                        ->first();
        return $ubicacion ? $ubicacion->hijos : collect([]);
    }
}

if (! function_exists('getBarrios')) {
    function getBarrios($corregimiento)
    {
        $ubicacion = App\Models\Ubicacion::where('nombre' , $corregimiento)
                                        ->where('tipo' , 3)
                                        ->first();
        return $ubicacion ? $ubicacion->hijos : collect([]);
    }
}

if (! function_exists('productosMasVendidos')) {
    function productosMasVendidos($limit = 12)
    {
        $productos = App\Models\Producto::withCount('ventas')
                            ->orderBy('ventas_count' , 'desc')
                            ->where('id_padre' , null)
                            ->where('estatus' , 1)
                            ->where('flag_activo' , 1 )
                            ->limit($limit)
                            ->get();
        return $productos;
    }
}


if (! function_exists('productosEnOferta')) {
    function productosEnOferta($limit = 12)
    {
        $productos = App\Models\Producto::where('antes' , '!=' , null)
                            ->where('id_padre' , null)
                            ->where('estatus' , 1)
                            ->where('flag_activo' , 1 )
                            ->orderBy('updated_at')
                            ->limit($limit)
                            ->get();
        return $productos;
    }
}


if (! function_exists('productosVendidosMesActual')) {
    function productosVendidosMesActual()
    {
        $ordenes = App\Models\OrdenItem::whereHas('orden' , function($query){
                                $query->whereMonth('created_at' , date('m'))
                                        ->whereYear('created_at' , date('Y'));
                            })
                            ->get();
        return $ordenes;
    }
}

if (! function_exists('productosVendidosPorNombreMesActual')) {
    function productosVendidosPorNombreMesActual()
    {
        $ordenes = App\Models\OrdenItem::whereHas('orden' , function($query){
                                $query->whereMonth('created_at' , date('m'))
                                        ->whereYear('created_at' , date('Y'));
                            })
                            ->select('*', Illuminate\Support\Facades\DB::raw('count(*) as conteo'))
                            ->groupBy('nombre')
                            ->orderBy('conteo' , 'desc')
                            ->limit(10)
                            ->get();
        return $ordenes;
    }
}

if (! function_exists('productosVendidosPorNombreArrayMesActual')) {
    function productosVendidosPorNombreArrayMesActual()
    {
        $ordenes = App\Models\OrdenItem::whereHas('orden' , function($query){
                                $query->whereMonth('created_at' , date('m'))
                                        ->whereYear('created_at' , date('Y'));
                            })
                            ->select('*', Illuminate\Support\Facades\DB::raw('count(*) as conteo'))
                            ->groupBy('nombre')
                            ->orderBy('conteo' , 'desc')
                            ->limit(10)
                            ->get();

        $out = [];

        foreach($ordenes as $orden)
        {
            $out[] = '"' . $orden->nombre . '"';
        }

        $outString = '[' . implode( ',' , $out) . ']'; 

        return $outString;
    }
}

if (! function_exists('productosVendidosPorNombreConteoMesActual')) {
    function productosVendidosPorNombreConteoMesActual()
    {
        $ordenes = App\Models\OrdenItem::whereHas('orden' , function($query){
                                $query->whereMonth('created_at' , date('m'))
                                        ->whereYear('created_at' , date('Y'));
                            })
                            // ->select('*', Illuminate\Support\Facades\DB::raw('count(*) as conteo'))
                            ->groupBy('nombre')
                            // ->orderBy('conteo' , 'desc')
                            ->get()
                            ->toArray();

        return count($ordenes);
    }
}

if (! function_exists('productosVendidosPorCantidadArrayMesActual')) {
    function productosVendidosPorCantidadArrayMesActual()
    {
        $ordenes = App\Models\OrdenItem::whereHas('orden' , function($query){
                                $query->whereMonth('created_at' , date('m'))
                                        ->whereYear('created_at' , date('Y'));
                            })
                            ->select('*', Illuminate\Support\Facades\DB::raw('count(*) as conteo'))
                            ->groupBy('nombre')
                            ->orderBy('conteo' , 'desc')
                            ->limit(10)
                            ->get();

        $out = [];

        foreach($ordenes as $orden)
        {
            $out[] = $orden->conteo;
        }

        $outString = '[' . implode( ',' , $out) . ']'; 

        return $outString;
    }
}

if (! function_exists('ordenesTotalMesActual')) {
    function ordenesTotalMesActual()
    {
        $total = 0;

        $ordenes = App\Models\Orden::whereMonth('created_at' , date('m'))
                            ->whereYear('created_at' , date('Y'))
                            ->get();
        
        foreach($ordenes as $orden)
        {
            $total += $orden->precioConImpuesto();
        }

        return $total;
    }
}

if (! function_exists('currentTienda')) {
    function currentTienda()
    {
        if(auth()->user())
        {
            return auth()->user()->tienda;
        }

        if( session()->has('tienda') )
        {
            return session('tienda');
        }

        return 1;
    }
}

if (! function_exists('currentTiendaName')) {
    function currentTiendaName()
    {
        $nombre = tiendaName(currentTienda());

        return $nombre;
    }
}

if (! function_exists('currentTiendaSlug')) {
    function currentTiendaSlug()
    {
        $tiendaInt = currentTienda();
        
        $tienda = App\Models\Tienda::find($tiendaInt);

        if(!$tienda)
        {
            return null;
        }

        return $tienda->slug;

        // funcion vieja
        // $slug = Str::slug(tiendaName($tiendaInt));
        switch ($tiendaInt) {
            case 1:
                $out="principal";
                break;
            case 2:
                $out="sucursal-1";
                break;
            case 3:
                $out="sucursal-2";
                break;
                
            default:
                $out="no-definido";
                break;
        }
        
        return $out;
    }
}

if (! function_exists('tiendaName')) {
    function tiendaName($tienda)
    {
        $tienda = App\Models\Tienda::find($tienda);

        if(!$tienda)
        {
            return null;
        }

        return $tienda->nombre;

        // funcion vieja
        switch ($tienda) {
            case 1:
                $out="Principal";
                break;
            case 2:
                $out="Sucursal 1";
                break;
            case 3:
                $out="Sucursal 2";
                break;
                
            default:
                $out="No Definido";
                break;
        }
        
        return $out;
    }
}

if (! function_exists('currentCountryName')) {
    function currentCountryName()
    {
        $nombre = App\Models\Pais::find(currentCountry())->nombre;
        
        return $nombre;
    }
}

if (! function_exists('productoDestacadoUno')) {
    function productoDestacadoUno()
    {
        $productoId = opcionSlug('producto_destacado_uno');
        $producto = App\Models\Producto::find($productoId);
        return $producto;
    }
}

if (! function_exists('productoDestacadoDos')) {
    function productoDestacadoDos()
    {
        $productoId = opcionSlug('producto_destacado_dos');
        $producto = App\Models\Producto::find($productoId);
        return $producto;
    }
}

if (! function_exists('categoriasPublicas')) {
    function categoriasPublicas($limit = null)
    {
        $categorias = App\Models\Categoria::where('estatus' , 1 )
                                            ->orderBy('nombre')
                                            ->where('padre_id' , null);

        if($limit)
        {
            $categorias = $categorias->limit($limit);
        }

        $categorias = $categorias->withCount('productos')
                                    ->get();

        return $categorias;
    }
}

if (! function_exists('coleccionesPublicas')) {
    function coleccionesPublicas($limit = null)
    {
        $colecciones = App\Models\Coleccion::where('estatus' , 1 )
                                            ->orderBy('nombre');

        if($limit)
        {
            $colecciones = $colecciones->limit($limit);
        }

        $colecciones = $colecciones->get();

        return $colecciones;
    }
}

if (! function_exists('categoriasPublicasTodas')) {
    function categoriasPublicasTodas()
    {
        $categorias = App\Models\Categoria::where('estatus' , 1 )
                                            ->orderBy('nombre')
                                            // ->where('padre_id' , null)
                                            ->get();

        return $categorias;
    }
}

if (! function_exists('findProducto')) {
    function findProducto($id)
    {
        $producto = App\Models\Producto::find($id);

        return $producto;
    }
}

if (! function_exists('findColeccion')) {
    function findColeccion($id)
    {
        $coleccion = App\Models\Coleccion::find($id);

        return $coleccion;
    }
}

if (! function_exists('findCategoriaSlug')) {
    function findCategoriaSlug($nombre)
    {
        $categoria = App\Models\Categoria::where('nombre' , $nombre )->first();
        
        return $categoria;
    }
}

if (! function_exists('findCategoria')) {
    function findCategoria($id)
    {
        $categoria = App\Models\Categoria::find($id);
        
        return $categoria;
    }
}

if (! function_exists('imagenProductoRand')) {
    function imagenProductoRand()
    {
        $prod = App\Models\Producto::where('imagen', '!=' , null )->inRandomOrder()->first();

        if(!$prod)
        {
            return null;
        }

        $imagen = $prod->imagen();
        
        return $imagen;
    }
}

if (! function_exists('categoriasHome')) {
    function categoriasHome()
    {
        $categorias = App\Models\Categoria::where('estatus' , 1 )
                                            ->whereHas('productosConImagen')
                                            ->limit(4)
                                            ->inRandomOrder()
                                            ->get();

        return $categorias;
    }
}

if (! function_exists('productoHome')) {
    function productoHome()
    {
        $productoId = opcionSlug('producto_home');

        if(!$productoId || $productoId == '')
        {
            return null;
        }

        $producto = App\Models\Producto::find($productoId);

        return $producto;
    }
}

if (! function_exists('categorizarProducto')) {
    function categorizarProducto($nombre)
    {
        $cat = App\Models\Categoria::where('nombre' , $nombre)->first();

        if(!$cat)
        {
            $catCreada = App\Models\Categoria::create(['nombre' => $nombre]);
            return $catCreada->id;
        }

        return $cat->id;
    }
}

if (! function_exists('tiendasDisponibles')) {
    function tiendasDisponibles()
    {
        $tiendas = App\Models\Tienda::where('estatus' , 1)->get();

        return $tiendas;

        $tiendas = [
            'principal' => 'Principal',
            'sucursal-1' => 'Sucursal 1',
            'sucursal-2' => 'Sucursal 2',
        ];

        return $tiendas;
    }
}

if (! function_exists('tiendaInteger')) {
    function tiendaInteger($slug)
    {
        $tiendas = [];
        $numero = 1;

        foreach(tiendasDisponibles() as $key => $tienda)
        {
            $tiendas[$key] = $numero;
            $numero ++;
        }

        return $tiendas[$slug];
    }
}

if (! function_exists('productosPublicos')) {
    function productosPublicos($limit = 8 , $categoria = null)
    {
        $productos = App\Models\Producto::where('estatus' , 1 )
                                ->where('flag_activo' , 1 );

        if($categoria)
        {
            $productos = $productos->where('categoria_id' , $categoria);
        }

        $productos = $productos->orderBy('id' , 'desc')
                                ->where('id_padre' , null)
                                ->limit($limit)
                                ->get();

        return $productos;
    }
}

if (! function_exists('productosRandom')) {
    function productosRandom($limit = 8 , $categoria = null)
    {
        $productos = App\Models\Producto::where('estatus' , 1 )
                                ->where('flag_activo' , 1 );

        if($categoria)
        {
            $productos = $productos->where('categoria_id' , $categoria);
        }

        $productos = $productos->inRandomOrder()
                                ->limit($limit)
                                ->get();

        return $productos;
    }
}