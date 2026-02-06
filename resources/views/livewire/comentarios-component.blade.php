<div>
    @if($modo == 'lista')
        <!-- Bootstrap Table with Header - Light -->
        <div class="card">
            <div class="d-flex justify-content-between">
                <h5 class="card-header">Lista de Comentarios</h5>
                <div class="d-flex align-items-center p-4">
                    {{-- <button wire:click.prevent="$set('modo' , 'edit')" class="btn btn-sm btn-primary">Nuevo</button> --}}
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Puntos</th>
                        <th>Comentario</th>
                        <th>Producto</th>
                        <th>Estatus</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($comentarios as $comentario)
                            <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ Str::title($comentario->nombre) }}</strong></td>
                            <td>{{ $comentario->puntos }}</td>
                            <td style="white-space: wrap">{{ $comentario->comentario }}</td>
                            <td>{{ $comentario->producto() }}</td>
                            <td><a href="#" wire:click.prevent="cambiarEstatus({{ $comentario->id }})">{{ $comentario->estatus() }}</a></td>
                            <td>
                                <a class="" href="#" wire:click.prevent="edit({{ $comentario->id }})"
                                    ><i class="bx bx-edit-alt me-1"></i> Editar</a>
                                <a class="text-danger" href="#" wire:click.prevent="delete({{ $comentario->id }})"
                                    ><i class="bx bx-trash me-1"></i> Eliminar</a>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $comentarios->links() }}
            </div>
        </div>
        <!-- Bootstrap Table with Header - Light -->
    @endif

    @if( $modo == 'edit')
        <form action="#" wire:submit.prevent="save">
            @csrf
            <div class="card mb-4">
                <div class="d-flex justify-content-between">
                    <h5 class="card-header">{{ $comentarioId ? 'Editar' : 'Crear' }} comentario</h5>
                    <div class="d-flex align-items-center p-4">
                        <a wire:click.prevent="resetForm" class="btn btn-sm btn-primary text-white">Volver</a>
                    </div>
                </div>
                <div class="card-body demo-vertical-spacing demo-only-element">
                    <div class="input-group input-group-merge">
                        <label class="input-group-text">Nombre</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Nombre"
                            aria-label="Nombre"
                            name="nombre"
                            aria-describedby="basic-addon-search31"
                            wire:model="comentario.nombre"
                        />
                    </div>
                    
                    
                    <div class="input-group input-group-merge">
                        <label class="input-group-text">Título</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Título"
                            aria-label="Título"
                            aria-describedby="basic-addon-search31"
                            wire:model="comentario.titulo"
                        />
                    </div>
                    
                    <div class="input-group input-group-merge">
                        <label class="input-group-text">Comentario</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Comentario"
                            aria-label="Comentario"
                            aria-describedby="basic-addon-search31"
                            wire:model="comentario.comentario"
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
                            wire:model="comentario.impuesto"
                        />
                    </div> --}}

                    <button type="submit" class="btn btn-primary">Guardar</button>

                    {{--<div class="input-group input-group-merge">
                    <span class="input-group-text">With textarea</span>
                    <textarea class="form-control" aria-label="With textarea"></textarea>
                    </div> --}}

                    
                </div>
            </div>
        </form>
    @endif
</div>
