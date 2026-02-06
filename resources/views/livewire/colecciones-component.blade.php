<div>
    @if($modo == 'lista')
        <!-- Bootstrap Table with Header - Light -->
        <div class="card">
            <div class="d-flex justify-content-between">
                <h5 class="card-header">Lista de Colecciones</h5>
                <div class="d-flex align-items-center p-4">
                    <button wire:click.prevent="$set('modo' , 'edit')" class="btn btn-sm btn-primary">Nuevo</button>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Productos</th>
                        <th>Estatus</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($colecciones as $coleccion)
                            <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ Str::title($coleccion->nombre) }}</strong></td>
                            <td>{{ $coleccion->descripcion }}</td>
                            <td>{{ $coleccion->productos->count() }}</td>
                            <td><a href="#" wire:click.prevent="cambiarEstatus({{ $coleccion->id }})">{{ $coleccion->estatus() }}</a></td>
                            <td>
                                <a class="" href="#" wire:click.prevent="edit({{ $coleccion->id }})"
                                    ><i class="bx bx-edit-alt me-1"></i> Editar</a>
                                <a class="text-danger" href="#" wire:click.prevent="delete({{ $coleccion->id }})"
                                    ><i class="bx bx-trash me-1"></i> Eliminar</a>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $colecciones->links() }}
            </div>
        </div>
        <!-- Bootstrap Table with Header - Light -->
    @endif

    @if( $modo == 'edit')
        <form action="#" wire:submit.prevent="save">
            @csrf

            <div class="row">
                <div class="col-md-3">
                    <div class="card mb-4">
                        <div class="card-body p-0">
                            <label for="imagen-file">
                                @if(is_string($imagen))
                                    <img src="{{ $imagen }}" alt="">
                                @else    
                                    <img src="{{ $imagen ? $imagen->temporaryUrl() : '' }}" alt="">
                                @endif
                            </label>
                        </div>
                    </div>    
                </div>
                <div class="col-md-9">
                    <div class="card mb-4">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-header">{{ $coleccionId ? 'Editar' : 'Crear' }} coleccion</h5>
                            <div class="d-flex align-items-center p-4">
                                <a wire:click.prevent="resetForm" class="btn btn-sm btn-primary text-white">Volver</a>
                            </div>
                        </div>
                        <div class="card-body demo-vertical-spacing demo-only-element">
                           
                            
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

                            <div class="input-group input-group-merge">
                                <label class="input-group-text">Nombre</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Nombre"
                                    aria-label="Nombre"
                                    name="nombre"
                                    aria-describedby="basic-addon-search31"
                                    wire:model="coleccion.nombre"
                                />
                            </div>
                            
                            
                            <div class="input-group input-group-merge">
                                <label class="input-group-text">Descripción</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Descripción"
                                    aria-label="Descripción"
                                    aria-describedby="basic-addon-search31"
                                    wire:model="coleccion.descripcion"
                                />
                            </div>
                            
                            {{-- <div class="input-group input-group-merge">
                                <label class="input-group-text">Impuesto (%)</label>
                                <input
                                    type="number"
                                    step="any"
                                    class="form-control"
                                    placeholder="Impuesto (%)"
                                    aria-label="Impuesto (%)"
                                    aria-describedby="basic-addon-search31"
                                    wire:model="coleccion.impuesto"
                                />
                            </div> --}}
        
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </form>
    @endif
</div>
