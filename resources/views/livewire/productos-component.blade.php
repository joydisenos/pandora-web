<div>
    @if($modo == 'lista')
        <!-- Bootstrap Table with Header - Light -->
        <div class="card">
            <div class="d-flex justify-content-between">
                <h5 class="card-header">Lista de Productos</h5>
                <div class="d-flex align-items-center p-4">
                    <select class="form-control form-control-sm mr-2 px-4" wire:model="categoriaId">
                        <option value="">Todas las Categorias</option>
                        @foreach(categoriasPublicas() as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                        @endforeach
                    </select>
                    @if(config('parts.multiTienda'))
                        <select class="form-control form-control-sm mr-2 px-4" wire:model="tienda">
                            <option value="">Todas las Tiendas</option>
                            @foreach(tiendasDisponibles() as $tienda)
                                <option value="{{ $tienda->id }}">{{ $tienda->nombre }}</option>
                            @endforeach
                        </select>
                    @endif
                    <button wire:click.prevent="$set('modo' , 'edit')" class="btn btn-sm btn-primary">Nuevo</button>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Antes</th>
                        @foreach(tiendasDisponibles() as $tienda)
                            <th>{{ $tienda->nombre }}</th>
                        @endforeach
                        <th>Precio</th>
                        <th>Descripción</th>
                        <th>Estatus</th>
                        <th>Slider</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($productos as $producto)
                            <tr>
                                <td><img src="{{ $producto->imagen() }}" style="width:30px;" alt=""></td>
                                <td>{{ $producto->id }}</td>
                                <td>{{ $producto->id_producto }}</td>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ Str::title($producto->nombre) }}</strong></td>
                                <td class="text-right">{{ $producto->antes ? '$'. number_format($producto->antes , 2 , ',' , '.') : '' }}</td>
                                
                                @foreach(tiendasDisponibles() as $tienda)
                                    <td>{{ $producto->disponible($tienda->id) }}</td>
                                @endforeach

                                <td class="text-right">${{ number_format($producto->precio , 2 , ',' , '.') }}</td>
                                <td>
                                    {{ Str::limit($producto->descripcion , 30) }}
                                </td>
                                <td>
                                    <a href="#" wire:click.prevent="cambiarEstatus({{ $producto->id }})">{{ $producto->estatus() }}</a>
                                </td>
                                <td>
                                    <a href="#" wire:click.prevent="verSlider({{ $producto->id }})">{{ $producto->estatusSlider() }}</a>
                                </td>
                                <td>
                                    <a class="" href="#" wire:click.prevent="edit({{ $producto->id }})"
                                        ><i class="bx bx-edit-alt me-1"></i> Editar</a>

                                    <a class="" href="{{route('producto' , Hashid::encode($producto->id) )}}"
                                        ><i class="bx bx-show me-1"></i> Ver</a>
                                    
                                    <a class="text-danger" href="#" wire:click.prevent="delete({{ $producto->id }})"
                                        ><i class="bx bx-trash me-1"></i> Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $productos->links() }}
            </div>
        </div>
        <!-- Bootstrap Table with Header - Light -->
    @endif

    @if( $modo == 'edit')
        <form action="#" wire:submit.prevent="save">
            @include('includes.mensajes')
            <div class="row">
                <div class="col-md-3">
                    
                    @if($imagen_web && $imagen_web != '')   
                        <div class="card mb-4">
                            <div class="card-body p-0">
                                <label for="imagen-web">
                                    @if(is_string($imagen_web))
                                        <img src="{{ $imagen_web }}" alt="">
                                    @else    
                                        <img src="{{ $imagen_web ? $imagen_web->temporaryUrl() : '' }}" alt="">
                                    @endif
                                </label>
                            </div>
                        </div> 
                    @endif
                    
                    <div class="card mb-4">
                        <div class="card-body p-0">
                            <label for="imagen-file">
                                @if(is_string($imagen))
                                    <img src="{{ $imagen }}" alt="">
                                @else    
                                    <img src="{{ $imagen ? $imagen->temporaryUrl() : '' }}" alt="">
                                @endif
                            </label>
                            {{-- <div wire:loading wire:target="imagen">
                                <div class="d-flex align-items-center w-100">
                                    <strong>Cargando Imagen...</strong>
                                    <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                                </div>
                            </div> --}}
                            <div class="px-2">
                                <h4 class="mt-4 mb-0">{{ isset($producto['nombre']) ? $producto['nombre'] : '' }}</h4>
                                
                                <p>{{ isset($producto['precio']) ? '$'.$producto['precio'] : '' }}</p>
                             
                            </div>
                        </div>
                    </div>


                    @if($ficha && $ficha != '')   
                        <div class="card mb-4">
                            <div class="card-body p-0">
                                <label for="imagen-web">
                                    @if(is_string($ficha))
                                        <a href="{{ $ficha }}" >
                                            Ver ficha
                                        </a>
                                    @else    
                                        <a href="{{ $ficha ? $ficha->temporaryUrl() : '' }}">
                                            Ver ficha
                                        </a>
                                    @endif
                                </label>
                            </div>
                        </div>    
                    @endif
                </div>    
                
                <div class="col-md-9">    
                    <div class="card mb-4">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-header">{{ $productoId ? 'Editar' : 'Crear' }} Producto</h5>
                            <div class="d-flex align-items-center p-4">
                                <a wire:click.prevent="volver" class="btn btn-sm btn-primary text-white">Volver</a>
                            </div>
                        </div>
                        <div class="card-body demo-vertical-spacing demo-only-element">
                            <div class="row">
                                <!-- <div class="col-12 mb-4">
                                    <div class="input-group input-group-merge">
                                        <label class="input-group-text">Video</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Link Youtube"
                                            aria-label="Link Youtube"
                                            aria-describedby="basic-addon-search31"
                                            wire:model="producto.video_link"
                                        />
                                    </div>
                                </div> -->

                                {{-- <div class="col-md-4 mb-4">
                                    <div class="input-group input-group-merge">
                                        <label class="input-group-text">Imagen Web</label>
                                        <input
                                            type="file"
                                            id="imagen-web"
                                            class="form-control"
                                            placeholder="Nombre"
                                            aria-label="Nombre"
                                            aria-describedby="basic-addon-search31"
                                            wire:model="imagen_web"
                                        />
                                    </div>
                                </div> --}}

                                <div class="col-md-12 mb-4">
                                    <div class="input-group input-group-merge">
                                        <label class="input-group-text">Imagen</label>
                                        <input
                                            type="file"
                                            id="imagen-file"
                                            class="form-control"
                                            placeholder="Nombre"
                                            aria-label="Nombre"
                                            aria-describedby="basic-addon-search31"
                                            wire:model="imagen"
                                        />
                                    </div>
                                </div>

                                {{-- <div class="col-md-4 mb-4">
                                    <div class="input-group input-group-merge">
                                        <label class="input-group-text">Ficha</label>
                                        <input
                                            type="file"
                                            id="ficha-prod"
                                            class="form-control"
                                            placeholder="Nombre"
                                            aria-label="Nombre"
                                            aria-describedby="basic-addon-search31"
                                            wire:model="ficha"
                                        />
                                    </div>
                                </div> --}}
                                
                                <div class="col-md-8 mb-4">
                                    <div class="input-group input-group-merge">
                                        <label class="input-group-text">Nombre</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Nombre"
                                            aria-label="Nombre"
                                            aria-describedby="basic-addon-search31"
                                            wire:model="producto.nombre"
                                        />
                                    </div>
                                </div>
                                
                                <div class="col-md-4 mb-4">
                                    <div class="input-group input-group-merge">
                                        <label class="input-group-text">Marca</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Marca"
                                            aria-label="Marca"
                                            aria-describedby="basic-addon-search31"
                                            wire:model="producto.marca"
                                        />
                                    </div>
                                </div>
                                
                                <div class="col-md-12 mb-4">
                                    <div class="input-group input-group-merge">
                                        <label class="input-group-text">Tallas</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Tallas"
                                            aria-label="Tallas"
                                            aria-describedby="basic-addon-search31"
                                            wire:model="producto.talla"
                                        />
                                    </div>
                                </div>
                                
                                <div class="col-md-12 mb-4">
                                    <div class="input-group input-group-merge">
                                        <label class="input-group-text">Colores</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Colores"
                                            aria-label="Colores"
                                            aria-describedby="basic-addon-search31"
                                            wire:model="producto.color"
                                        />
                                    </div>
                                </div>
                                
                                <div class="col-md-4 mb-4">
                                    <div class="input-group input-group-merge">
                                        <label class="input-group-text">SKU</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="SKU"
                                            aria-label="SKU"
                                            aria-describedby="basic-addon-search31"
                                            wire:model="producto.sku_producto"
                                        />
                                    </div>
                                </div>
                                
                                <div class="col-md-4 mb-4">
                                    <div class="input-group input-group-merge">
                                        <label class="input-group-text">Precio</label>
                                        <input
                                            type="number"
                                            step="any"
                                            class="form-control"
                                            placeholder="Precio"
                                            aria-label="Precio"
                                            aria-describedby="basic-addon-search31"
                                            wire:model="producto.precio"
                                        />
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" wire:model="producto.exento">
                                        <label class="form-check-label" for="defaultCheck1" >
                                            Exento de impuesto
                                        </label>
                                      </div>
                                </div>
                                
                                <div class="col-md-4 mb-4">
                                    <div class="input-group input-group-merge">
                                        <label class="input-group-text">Precio Antes</label>
                                        <input
                                            type="number"
                                            step="any"
                                            class="form-control"
                                            placeholder="Antes"
                                            aria-label="Antes"
                                            aria-describedby="basic-addon-search31"
                                            wire:model="producto.antes"
                                        />
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">Categoría</span>
                                        <select class="form-control" aria-label="Descripcion" wire:model="producto.categoria_id">
                                            <option value="">Seleccione</option>
                                            @foreach(categoriasPublicas() as $categoria)
                                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>
                                
                                <div class="col-md-4 mb-4">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">SubCategoría</span>
                                        <select class="form-control" aria-label="Descripcion" wire:model="producto.subcategoria_id">
                                            <option value="">Seleccione</option>
                                            @foreach($this->subcategorias() as $subcategoria)
                                                <option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>
                                
                                {{-- <div class="col-md-4 mb-4">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">Colección</span>
                                        <select class="form-control" aria-label="Colección" wire:model="producto.coleccion_id">
                                            <option value="">Seleccione</option>
                                            @foreach(coleccionesPublicas() as $coleccion)
                                                <option value="{{ $coleccion->id }}">{{ $coleccion->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                </div> --}}
                                
                                {{-- <div class="col-md-4 mb-4">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">Tienda</span>
                                        <select class="form-control" aria-label="Descripcion" wire:model="producto.tienda">
                                            <option value="">Seleccione</option>
                                                <option value="1">Avenida B</option>
                                                <option value="2">Chorrera</option>
                                                <option value="3">24 de Diciembre</option>
                                        </select>
                                    </div> 
                                </div> --}}

                                {{-- <div class="col-md-4 mb-4">
                                    <div class="input-group input-group-merge">
                                        <label class="input-group-text">Stock</label>
                                        <input
                                            type="number"
                                            class="form-control"
                                            placeholder="Stock"
                                            aria-label="Stock"
                                            aria-describedby="basic-addon-search31"
                                            wire:model="producto.disponible"
                                        />
                                    </div>
                                </div> --}}

                                {{-- <div class="col-md-4 mb-4">
                                    <div class="input-group input-group-merge">
                                        <label class="input-group-text">Cubicaje X</label>
                                        <input
                                            type="number"
                                            step="any"
                                            class="form-control"
                                            placeholder="Cubicaje X"
                                            aria-label="Cubicaje X"
                                            aria-describedby="basic-addon-search31"
                                            wire:model="producto.cubicaje_x"
                                        />
                                    </div>
                                </div> --}}

                                {{-- <div class="col-md-4 mb-4">
                                    <div class="input-group input-group-merge">
                                        <label class="input-group-text">Cubicaje Y</label>
                                        <input
                                            type="number"
                                            step="any"
                                            class="form-control"
                                            placeholder="Cubicaje Y"
                                            aria-label="Cubicaje Y"
                                            aria-describedby="basic-addon-search31"
                                            wire:model="producto.cubicaje_y"
                                        />
                                    </div>
                                </div> --}}

                                {{-- <div class="col-md-4 mb-4">
                                    <div class="input-group input-group-merge">
                                        <label class="input-group-text">Cubicaje Z</label>
                                        <input
                                            type="number"
                                            step="any"
                                            class="form-control"
                                            placeholder="Cubicaje Z"
                                            aria-label="Cubicaje Z"
                                            aria-describedby="basic-addon-search31"
                                            wire:model="producto.cubicaje_z"
                                        />
                                    </div>
                                </div> --}}

                                {{-- <div class="col-md-4 mb-4">
                                    <div class="input-group input-group-merge">
                                        <label class="input-group-text">Peso</label>
                                        <input
                                            type="number"
                                            step="any"
                                            class="form-control"
                                            placeholder="Peso"
                                            aria-label="Peso"
                                            aria-describedby="basic-addon-search31"
                                            wire:model="producto.peso"
                                        />
                                    </div>
                                </div> --}}
                                
                                {{-- <div class="col-md-4 mb-4">
                                    <div class="input-group input-group-merge">
                                        <label class="input-group-text">Id Padre</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Id Padre"
                                            aria-label="Id Padre"
                                            aria-describedby="basic-addon-search31"
                                            wire:model="producto.id_padre"
                                        />
                                    </div>
                                </div> --}}
                                
                                <div class="col-md-4 mb-4">
                                    
                                      
                                      
                                </div>

                                <div class="col-md-12 mb-4">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">Descripción</span>
                                        <textarea class="form-control" aria-label="Descripcion" wire:model="producto.descripcion"></textarea>
                                    </div> 
                                </div>
                               
                                <div class="col-md-12 mb-4">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">Detalles</span>
                                        <textarea class="form-control" aria-label="Descripcion" wire:model="producto.detalles"></textarea>
                                    </div> 
                                </div>
                                @if(count(tiendasDisponibles()))
                                    <div class="col-12">
                                        <h6>Stock por tienda</h6>
                                    </div>
                                    @foreach(tiendasDisponibles() as $tienda)
                                        <div class="row p-3">
                                            <div class="col-md-8">
                                                {{ $tienda->nombre }}
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" placeholder="stock disponible {{ $tienda->nombre }}" wire:model="stocks.{{ $tienda->id }}">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            
                            

                            
                            
                            
                            
                            <button class="btn btn-primary" type="submit" wire:loading.attr="disabled">Guardar</button>
                            {{--<div class="input-group input-group-merge">
                            <span class="input-group-text">With textarea</span>
                            <textarea class="form-control" aria-label="With textarea"></textarea>
                            </div> --}}

                            
                        </div>
                    </div>

                    @if($productoId && !$padreId)
                    <div class="card mb-4">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-header">Sub Productos</h5>
                            <div class="d-flex align-items-center p-4">
                                <button wire:click.prevent="crearSubproducto" class="btn btn-sm btn-primary">Nuevo Sub Producto</button>
                            </div>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead class="table-light">
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Estatus</th>
                                    <th>Acción</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach($subproductos as $subproducto)
                                        <tr>
                                            <td><img src="{{ $subproducto->imagen() }}" style="width:30px;" alt=""></td>
                                            <td>{{ $subproducto->id }}</td>
                                            <td>{{ $subproducto->id_producto }}</td>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ Str::title($subproducto->nombre) }}</strong></td>
                                            <td class="text-right">${{ number_format($subproducto->precio , 2 , ',' , '.') }}</td>
                                            <td>
                                                <a href="#" wire:click.prevent="cambiarEstatus({{ $subproducto->id }})">{{ $subproducto->estatus() }}</a>
                                            </td>
                                            <td>
                                                <a class="" href="#" wire:click.prevent="editSubproducto({{ $subproducto->id }})"
                                                    ><i class="bx bx-edit-alt me-1"></i> Editar</a>
                                                
                                                <a class="text-danger" href="#" wire:click.prevent="delete({{ $subproducto->id }})"
                                                    ><i class="bx bx-trash me-1"></i> Eliminar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                    
                    <div class="card mb-4">
                        <div class="card-body">
                            <label for="file" class="btn btn-block btn-outline-primary w-100 mb-4">Agregar Foto (Galería)</label>
                            <input type="file" id="file" wire:model="file" class="d-none">

                            @if($productoId)
                                <div class="row d-flex">
                                    @foreach(findProducto($productoId)->galeria as $galeria )
                                        <div class="col-md-3 mb-4">
                                            <div class="img-gal">
                                                <img src="{{ $galeria->imagen() }}" alt="">
                                            </div>

                                            <button class="btn btn-outline-danger w-100 text-center d-flex justify-content-center" wire:click.prevent="deleteGaleria({{$galeria->id}})">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <!-- productos derivados o modelos -->
                            
                        </div>
                    </div>

                    @if(config('parts.precioVariable'))
                        <div class="card">
                            <div class="card-body">
                                <button class="btn btn-block btn-outline-primary w-100 mb-4" wire:click.prevent="agregarVariablePrecio">Agregar variable de precio</button>

                                @if($productoId)
                                    <div class="row d-flex">
                                        @foreach($variablePrecio as $key => $precio )
                                            <div class="col-md-2 mb-4 d-flex align-items-end">
                                                <button class="btn btn-outline-danger text-center d-flex justify-content-center" wire:click.prevent="deletePrecio({{$precio['id']}})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="col-md-3 mb-4">
                                                <label for="">Cantidad Mínima</label>
                                                <input type="number" class="form-control" wire:model="variablePrecio.{{$key}}.cantidad">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label for="">Tipo</label>
                                                <select name="tipo" class="form-control" id="" wire:model="variablePrecio.{{$key}}.tipo">
                                                    <option value="1">Precio Fijo</option>
                                                    <option value="2">Porcentaje Descuento</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-4">
                                                @if($precio['tipo'] == 1)
                                                    <label for="">Precio</label>
                                                    <input type="number" class="form-control" step="any" wire:model="variablePrecio.{{$key}}.precio">
                                                    @endif
                                                    @if($precio['tipo'] == 2)
                                                    <label for="">Porcentaje</label>
                                                    <input type="number" class="form-control" step="any" wire:model="variablePrecio.{{$key}}.porcentaje">
                                                @endif
                                            </div>
                                            <div class="col-12">
                                                <hr>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </form>
    @endif
</div>
