<div>
    @if($modo == 'lista')
        <!-- Bootstrap Table with Header - Light -->
        <div class="card">
            <div class="d-flex justify-content-between">
                <h5 class="card-header">Listado de Órdenes</h5>
                <div class="d-flex align-items-center p-4">
                    <select class="form-control form-control-sm mr-2" wire:model="estatus">
                        <option value="">Todas</option>
                        <option value="0">Negado</option>
                        <option value="1">Pendiente</option>
                        <option value="2">Aprobado</option>
                        
                    </select>

                    <button wire:click.prevent="$set('modo' , 'edit')" class="btn btn-sm btn-primary">Nuevo</button>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Tienda origen</th>
                        <th>Nombre</th>
                        <th>Cédula</th>
                        <th>Precio</th>
                        <th>Estatus</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody class="table-borden-bottom-0">
                        @foreach($ordens as $orden)
                            <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $orden->id }}</strong></td>
                                <td>{{ $orden->created_at->format('d/m/Y') }}</td>
                                <td>{{ $orden->tienda() }}</td>
                                <td>
                                    {{ $orden->nombreCompleto() }}
                                </td>
                                <td>
                                    {{ $orden->cedula }}
                                </td>
                                <td class="text-right">
                                    {{ number_format($orden->precioConImpuesto() , 2) }}
                                </td>
                                <td>
                                    {{ $orden->estatus() }}
                                </td>
                                <td>
                                    <a class="" href="#" wire:click.prevent="edit({{ $orden->id }})"
                                        ><i class="bx bx-edit-alt me-1"></i> Editar</a>
                                    <a class="" href="#" wire:click.prevent="delete({{ $orden->id }})"
                                        ><i class="bx bx-trash me-1"></i> Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $ordens->links() }}
            </div>
        </div>
        <!-- Bootstrap Table with Header - Light -->
    @endif

    @if( $modo == 'edit')
        <form action="#" wire:submit.prevent="save">
            @include('includes.mensajes')
            <div class="card mb-4">
                <div class="d-flex justify-content-between">
                    <h5 class="card-header">{{ $ordenId ? 'Editar' : 'Crear' }} orden</h5>
                    <div class="d-flex align-items-center p-4">
                        <a wire:click.prevent="resetForm" class="btn btn-sm btn-primary text-white">Volver</a>
                    </div>
                </div>
                <div class="card-body demo-vertical-spacing demo-only-element">
                    <div class="row">

                        <div class="col-md-4 mb-4">
                            <div class="input-group input-group-merge">
                                <label class="input-group-text">Cédula</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Cédula"
                                    aria-label="Cédula"
                                    aria-describedby="basic-addon-search31"
                                    wire:model="orden.cedula"
                                />
                            </div>

                            @if(count($sugerencias))
                                <div>
                                    @foreach($sugerencias as $sugerencia)
                                        <a href="#" wire:click.prevent="setCliente({{ $sugerencia->id }})">
                                            <span class="badge bg-primary">
                                                {{ $sugerencia->nombreCompleto() }}
                                            </span>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="input-group input-group-merge">
                                <label class="input-group-text">Nombre</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Nombre"
                                    aria-label="Nombre"
                                    aria-describedby="basic-addon-search31"
                                    wire:model="orden.nombre"
                                />
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="input-group input-group-merge">
                                <label class="input-group-text">Apellido</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Apellido"
                                    aria-label="Apellido"
                                    aria-describedby="basic-addon-search31"
                                    wire:model="orden.apellido"
                                />
                            </div>
                        </div>



                        <div class="col-md-3 mb-4">
                            <div class="input-group input-group-merge">
                                <label class="input-group-text">Provincia</label>
                                <select name="" id="" wire:model="orden.provincia" class="form-control">
                                    <option value="">Provincia</option>
                                    @foreach(getProvincias() as $ubicacion)
                                    <option value="{{ $ubicacion->nombre }}">{{ $ubicacion->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-3 mb-4">
                            <div class="input-group input-group-merge">
                                <label class="input-group-text">Distrito</label>
                                <select name="" id=""  class="form-control" wire:model="orden.distrito">
                                    <option value="">Distrito</option>
                                    @if(isset($orden['provincia']) && $orden['provincia'] && $orden['provincia'] != '')
                                        @foreach(getDistritos($orden['provincia']) as $ubicacion)
                                        <option value="{{ $ubicacion->nombre }}">{{ $ubicacion->nombre }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-3 mb-4">
                            <div class="input-group input-group-merge">
                                <label class="input-group-text">Corregimiento</label>
                                <select name="" id=""  class="form-control" wire:model="orden.corregimiento">
                                    <option value="">Corregimiento</option>
                                    @if(isset($orden['distrito']) && $orden['distrito'] && $orden['distrito'] != '')
                                        @foreach(getCorregimientos($orden['distrito']) as $ubicacion)
                                        <option value="{{ $ubicacion->nombre }}">{{ $ubicacion->nombre }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-3 mb-4">
                            <div class="input-group input-group-merge">
                                <label class="input-group-text">Barrio</label>
                                <select name="" id=""  class="form-control" wire:model="orden.corregimiento">
                                    <option value="">Barrio</option>
                                    @if(isset($orden['corregimiento']) && $orden['corregimiento'] && $orden['corregimiento'] != '')
                                        @foreach(getBarrios($orden['corregimiento']) as $ubicacion)
                                        <option value="{{ $ubicacion->nombre }}">{{ $ubicacion->nombre }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-12 mb-4">
                            <div class="input-group input-group-merge">
                                <label class="input-group-text">Dirección</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Dirección"
                                    aria-label="Dirección"
                                    aria-describedby="basic-addon-search31"
                                    wire:model="orden.direccion"
                                />
                            </div>
                        </div>

                        @if(isset($orden['retiro']) && $orden['retiro'] == 2)
                            <div class="col-12">
                                <hr>
                                <h3>Datos de Envío</h3>
                            </div>

                            <div class="col-md-3 mb-4">
                                <div class="input-group input-group-merge">
                                    <label class="input-group-text">Provincia (Envío)</label>
                                    <select name="" id="" wire:model="orden.provincia_envio" class="form-control">
                                        <option value="">Provincia</option>
                                        @foreach(getProvincias() as $ubicacion)
                                        <option value="{{ $ubicacion->nombre }}">{{ $ubicacion->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-3 mb-4">
                                <div class="input-group input-group-merge">
                                    <label class="input-group-text">Distrito (Envío)</label>
                                    <select name="" id=""  class="form-control" wire:model="orden.distrito_envio">
                                        <option value="">Distrito</option>
                                        @if(isset($orden['provincia_envio']) && $orden['provincia_envio'] && $orden['provincia_envio'] != '')
                                            @foreach(getDistritos($orden['provincia_envio']) as $ubicacion)
                                            <option value="{{ $ubicacion->nombre }}">{{ $ubicacion->nombre }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-3 mb-4">
                                <div class="input-group input-group-merge">
                                    <label class="input-group-text">Corregimiento (Envío)</label>
                                    <select name="" id=""  class="form-control" wire:model="orden.corregimiento_envio">
                                        <option value="">Corregimiento</option>
                                        @if(isset($orden['distrito_envio']) && $orden['distrito_envio'] && $orden['distrito_envio'] != '')
                                            @foreach(getCorregimientos($orden['distrito_envio']) as $ubicacion)
                                            <option value="{{ $ubicacion->nombre }}">{{ $ubicacion->nombre }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-3 mb-4">
                                <div class="input-group input-group-merge">
                                    <label class="input-group-text">Barrio (Envío)</label>
                                    <select name="" id=""  class="form-control" wire:model="orden.barrio_envio">
                                        <option value="">Barrio</option>
                                        @if(isset($orden['corregimiento_envio']) && $orden['corregimiento_envio'] && $orden['corregimiento_envio'] != '')
                                            @foreach(getBarrios($orden['corregimiento_envio']) as $ubicacion)
                                            <option value="{{ $ubicacion->nombre }}">{{ $ubicacion->nombre }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-12 mb-4">
                                <div class="input-group input-group-merge">
                                    <label class="input-group-text">Dirección de envío</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Dirección"
                                        aria-label="Dirección"
                                        aria-describedby="basic-addon-search31"
                                        wire:model="orden.direccion_envio"
                                    />
                                </div>
                            </div>

                            <div class="col-12">
                                <hr>
                            </div>
                        @endif

                        <div class="col-md-4 mb-4">
                            <div class="input-group input-group-merge">
                                <label class="input-group-text">Método de Pago</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Método de Pago"
                                    aria-label="Método de Pago"
                                    aria-describedby="basic-addon-search31"
                                    wire:model="orden.tipo_pago"
                                />
                            </div>
                        </div>

                        @if(config('parts.envios'))
                            <div class="col-md-4 mb-4">
                                <div class="input-group input-group-merge">
                                    <label class="input-group-text">Método de Envío</label>
                                    <select
                                        type="text"
                                        class="form-control"
                                        placeholder="Envío"
                                        aria-label="Envío"
                                        aria-describedby="basic-addon-search31"
                                        wire:model="orden.retiro"
                                    >
                                        <option value="">Seleccione</option>
                                        <option value="1">Retiro en Tienda</option>
                                        <option value="2">Delivery</option>
                                        <option value="3">Envío por encomienda</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div class="input-group input-group-merge">
                                    <label class="input-group-text">Costo de Envío</label>
                                    <input
                                        type="number"
                                        min="0"
                                        step="any"
                                        class="form-control"
                                        placeholder="Costo de Envío"
                                        aria-label="Costo de Envío"
                                        aria-describedby="basic-addon-search31"
                                        wire:model="orden.envio"
                                    />
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-4">
                                <div class="input-group input-group-merge">
                                    <label class="input-group-text">Transportista</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Transportista"
                                        aria-label="Transportista"
                                        aria-describedby="basic-addon-search31"
                                        wire:model="orden.transportista"
                                    />
                                </div>
                            </div>
                        @endif
                        <div class="col-md-4 mb-4">
                            <div class="input-group input-group-merge">
                                <label class="input-group-text">Impuesto (%)</label>
                                <input
                                    type="number"
                                    step="any"
                                    class="form-control"
                                    placeholder="Impuesto"
                                    aria-label="Impuesto"
                                    aria-describedby="basic-addon-search31"
                                    wire:model="orden.impuesto"
                                />
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="input-group input-group-merge">
                                <label class="input-group-text">Estatus</label>
                                <select
                                    type="text"
                                    class="form-control"
                                    placeholder="Estatus"
                                    aria-label="Estatus"
                                    aria-describedby="basic-addon-search31"
                                    wire:model="orden.estatus"
                                >
                                    <option value="0">Negado</option>
                                    <option value="1">Pendiente</option>
                                    <option value="2">Aprobado</option>
                                </select>
                            </div>
                        </div>

                        {{-- <div class="col-md-12">
                            <div class="input-group input-group-merge">
                            <label class="input-group-text">Recomendaciones</label>
                            <textarea class="form-control" name="" id="" cols="30" rows="1" wire:model="orden.recomendaciones" readonly></textarea>
                            </div>
                        </div> --}}

                    </div>

                    <hr>
                    <h3>Agregar Items</h3>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group input-group-merge">
                                <label class="input-group-text">Producto</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Producto"
                                    aria-label="Producto"
                                    aria-describedby="basic-addon-search31"
                                    wire:model="producto.nombre"
                                />
                            </div>

                            @if(count($sugerenciasProductos))
                                <div>
                                    @foreach($sugerenciasProductos as $sugerenciaProducto)
                                        <a href="#" wire:click.prevent="setProducto({{ $sugerenciaProducto->id }})">
                                            <span class="badge bg-primary">
                                                {{ $sugerenciaProducto->nombre }}
                                            </span>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        
                        <div class="col-md-2">
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
                        
                        <div class="col-md-2">
                            <div class="input-group input-group-merge">
                                <label class="input-group-text">Imp. (%)</label>
                                <input
                                    type="number"
                                    step="any"
                                    class="form-control"
                                    placeholder="Impuesto"
                                    aria-label="Impuesto"
                                    aria-describedby="basic-addon-search31"
                                    wire:model="producto.impuesto"
                                />
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <div class="input-group input-group-merge">
                                <label class="input-group-text">Cantidad</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    placeholder="Cantidad"
                                    aria-label="Cantidad"
                                    aria-describedby="basic-addon-search31"
                                    wire:model="producto.cantidad"
                                />
                            </div>
                        </div>

                        <div class="col-md-2">
                            <a class="btn btn-primary text-white w-100" wire:click.prevent="addItem">
                                Agregar
                            </a>
                        </div>
                    </div>

                    <hr>
                    <h3>Items</h3>

                    <table class="table">
                        <thead>
                            <th></th>
                            <th>Item</th>
                            <th>Cantidad</th>
                            <th class="text-right">Precio</th>
                            <th class="text-right">Impuesto</th>
                            <th class="text-right">Total ($)</th>
                        </thead>
                        <tbody>
                            @foreach($items as $key => $item)
                                <tr>
                                    <td><a href="#" wire:click.prevent="removeItem({{ $key }})">eliminar</a></td>
                                    <td>{{ $item['nombre'] }}</td>
                                    <td>{{ $item['cantidad'] }}</td>
                                    <td class="text-right">{{ number_format($item['precio'] , 2) }}</td>
                                    <td class="text-right">{{ number_format($item['impuesto'] , 2) }}</td>
                                    <td class="text-right">{{ number_format($this->precioItem($item) , 2) }}</td>
                                </tr>
                            @endforeach
                            
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right">Subtotal:</td>
                                <td class="text-right">{{ $this->subtotal() }}</td>
                            </tr>

                            @if($this->impuesto() > 0)
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right">Impuesto({{ $this->impuestoPorcentaje() }}):</td>
                                    <td class="text-right">{{ $this->impuesto() }}</td>
                                </tr>
                            @endif
                            
                            @if($this->envio() > 0)
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right">Envío:</td>
                                    <td class="text-right">{{ $this->envio() }}</td>
                                </tr>
                            @endif
                            
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right">Total:</td>
                                <td class="text-right">{{ $this->total() }}</td>
                            </tr>

                        </tbody>
                    </table>
                    
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                        @if($ordenId)
                            <a href="#" class="btn btn-primary ml-auto">Facturar</a>
                        @endif
                    </div>
                    {{--<div class="input-group input-group-merge">
                    <span class="input-group-text">With textarea</span>
                    <textarea class="form-control" aria-label="With textarea"></textarea>
                    </div> --}}

                    
                </div>
            </div>
        </form>
    @endif
</div>
