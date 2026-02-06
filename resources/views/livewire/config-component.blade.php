<div>
    <form action="#" wire:submit.prevent="guardar">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Datos Generales</h4>
            </div>
            <div class="card-body">
                    {{-- <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Producto Home</label>
                        </div>
                        <div class="col-md-8">
                            <select wire:model="opcion.producto_home" class="form-control">
                                <option value="">No Seleccionado</option>
                                @foreach (productosPublicos() as $producto)
                                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Logotipo</label>
                        </div>
                        <div class="col-md-8">
                            <img src="{{ $logotipo }}" class="img-fluid" alt="">
                            <input type="file" class="" wire:model="logotipo">
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Favicon</label>
                        </div>
                        <div class="col-md-8">
                            <img src="{{ $logotipoAdmin }}" class="img-fluid" alt="">
                            <input type="file" class="" wire:model="logotipoAdmin">
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Imagen footer</label>
                        </div>
                        <div class="col-md-8">
                            <img src="{{ $imagenWeb }}" class="img-fluid" alt="">
                            <input type="file" class="" wire:model="imagenWeb">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Título principal</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" wire:model="opcion.titulo_principal">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Descripción del Sitio</label>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control" wire:model="opcion.descripcion_sitio"></textarea>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">URL Catálogo</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" wire:model="opcion.url_catalogo">
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Producto Destacado Uno (ID)</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control" wire:model="opcion.producto_destacado_uno">
                        </div>
                    </div>
                    
                    <!-- <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Producto Destacado Dos (ID)</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control" wire:model="opcion.producto_destacado_dos">
                        </div>
                    </div> -->
                    
                    <!-- <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Imagen Principal de tienda</label>
                        </div>
                        <div class="col-md-8">
                            <img src="{{ $tienda }}" class="img-fluid" alt="">
                            <input type="file" class="" wire:model="tienda">
                        </div>
                    </div> -->

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Título tienda</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" wire:model="opcion.titulo_tienda">
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Descripción de tienda</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" wire:model="opcion.descripcion_tienda">
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Descripción de blog</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" wire:model="opcion.descripcion_blog">
                        </div>
                    </div>
                    
                    {{-- <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Categoría 1</label>
                        </div>
                        <div class="col-md-8">
                            <select name="" id="" class="form-control" wire:model="opcion.categoria_1">
                                <option value="">Seleccione una Categoría</option>
                                @foreach(categoriasPublicas() as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Categoría 2</label>
                        </div>
                        <div class="col-md-8">
                            <select name="" id="" class="form-control" wire:model="opcion.categoria_2">
                                <option value="">Seleccione una Categoría</option>
                                @foreach(categoriasPublicas() as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Categoría 3</label>
                        </div>
                        <div class="col-md-8">
                            <select name="" id="" class="form-control" wire:model="opcion.categoria_3">
                                <option value="">Seleccione una Categoría</option>
                                @foreach(categoriasPublicas() as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Categoría 4</label>
                        </div>
                        <div class="col-md-8">
                            <select name="" id="" class="form-control" wire:model="opcion.categoria_4">
                                <option value="">Seleccione una Categoría</option>
                                @foreach(categoriasPublicas() as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">ITBMS (%)</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control" wire:model="opcion.impuesto">
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Texto nosotros (home)</label>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control" wire:model="opcion.nosotros_texto"></textarea>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Texto nosotros (sección nosotros)</label>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control" wire:model="opcion.nosotros_texto_seccion"></textarea>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Texto Nuestra Marca</label>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control" wire:model="opcion.nuestra_marca_texto"></textarea>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Texto Contacto</label>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control" wire:model="opcion.contacto_texto"></textarea>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Titulo de Banner 1</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" wire:model="opcion.banner_1_titulo">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Texto de Banner 1</label>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control" wire:model="opcion.banner_1_texto"></textarea>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Titulo de Banner 2</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" wire:model="opcion.banner_2_titulo">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Texto de Banner 2</label>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control" wire:model="opcion.banner_2_texto"></textarea>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Titulo de Banner 3</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" wire:model="opcion.banner_3_titulo">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Texto de Banner 3</label>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control" wire:model="opcion.banner_3_texto"></textarea>
                        </div>
                    </div>



                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Dirección</label>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control" wire:model="opcion.direccion"></textarea>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Email de Contacto</label>
                        </div>
                        <div class="col-md-8">
                            <input type="email" class="form-control" wire:model="opcion.email_contacto">
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Email de Notificación</label>
                        </div>
                        <div class="col-md-8">
                            <input type="email" class="form-control" wire:model="opcion.email_notificacion">
                        </div>
                    </div>

                    <!-- <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Datos Transferencia</label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="" class="form-control" id="" cols="30" rows="10" wire:model="opcion.datos_transferencia"></textarea>
                        </div>
                    </div> -->

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Teléfono</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" wire:model="opcion.telefono_contacto">
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Horario de atención</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" wire:model="opcion.horario_atencion">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Instagram</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" wire:model="opcion.red_instagram">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Facebook</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" wire:model="opcion.red_facebook">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Twitter</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" wire:model="opcion.red_twitter">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Youtube</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" wire:model="opcion.red_youtube">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Linked In</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" wire:model="opcion.red_linkedin">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Política de Privacidad</label>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control" wire:model="opcion.politica_privacidad"></textarea>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="">Términos y Condiciones</label>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control" wire:model="opcion.terminos_condiciones"></textarea>
                        </div>
                    </div>

                    
                    @include('includes.mensajes')
                    
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                {{-- <span wire:loading wire:target="guardar">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                </span> --}}
                                Guardar</button>
                        </div>
                    </div>
                
            </div>
        </div>

        @if(config('parts.apiToken'))
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Datos API</h4>
            </div>
            <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="" class="d-flex justify-content-between">Api Token 
                                <a href="#" wire:click.prevent="generarToken"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                                  </svg>
                                </a>
                            </label>
                        </div>
                        <div class="col-md-8">
                            {{-- <input type="text" class="form-control" wire:model="opcion.api_token"> --}}
                            {{ opcionSlug('api_token') }}
                        </div>
                    </div>
                
            </div>
        </div>
        @endif
    </form>


</div>
