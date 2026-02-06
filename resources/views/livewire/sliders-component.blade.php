<div>
    @if($modo == 'lista')
        <!-- Bootstrap Table with Header - Light -->
        <div class="card">
            <div class="d-flex justify-content-between">
                <h5 class="card-header">Lista de Sliders</h5>
                <div class="d-flex align-items-center p-4">
                    <button wire:click.prevent="$set('tipo' , 1)" class="btn btn-sm btn-{{ $tipo == 1 ? 'primary' : 'outline-primary' }} mr-2">Principal</button>
                    <button wire:click.prevent="$set('tipo' , 2)" class="btn btn-sm btn-{{ $tipo == 2 ? 'primary' : 'outline-primary' }}">Logos</button>
                </div>
                <div class="d-flex align-items-center p-4">
                    <button wire:click.prevent="crear" class="btn btn-sm btn-primary">Nuevo</button>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                    <tr>
                        <th></th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Descripción</th>
                        <th>Link</th>
                        <th>Estatus</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($sliders as $slider)
                            <tr>
                            <td><img src="{{ $slider->imagen() }}" style="width:50px" alt=""></td>
                            <td>{{ $slider->nombre }}</td>
                            <td>{{ $slider->tipo() }}</td>
                            <td>{{ $slider->descripcion }}</td>
                            <td><a href="{{ $slider->link }}">{{ $slider->link }}</a></td>
                            <td><a href="#" wire:click.prevent="cambiarEstatus({{ $slider->id }})">{{ $slider->estatus() }}</a></td>
                            <td>
                                <a class="" href="#" wire:click.prevent="edit({{ $slider->id }})"
                                    ><i class="bx bx-edit-alt me-1"></i> Editar</a>
                                <a class="text-danger" href="#" wire:click.prevent="delete({{ $slider->id }})"
                                    ><i class="bx bx-trash me-1"></i> Eliminar</a>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $sliders->links() }}
            </div>
        </div>
        <!-- Bootstrap Table with Header - Light -->
    @endif

    @if( $modo == 'edit')
        <form action="#" wire:submit.prevent="save">
            @csrf
            
            <div class="card mb-4">
                <div class="d-flex justify-content-between">
                    <h5 class="card-header">{{ $sliderId ? 'Editar' : 'Crear' }} slider</h5>
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
                    {{-- <div class="input-group input-group-merge">
                        <label class="input-group-text">Tipo</label>
                        <select
                            class="form-control"
                            placeholder="Tipo"
                            aria-label="Tipo"
                            name="tipo"
                            aria-describedby="basic-addon-search31"
                            wire:model="slider.tipo"
                        >
                            <option value="1">Principal</option>
                            <option value="2">Logos</option>
                        </select>
                    </div> --}}
                    
                    <div class="input-group input-group-merge">
                        <label class="input-group-text">Descripción superior</label>
                        <input
                            type="text"
                            maxlength="250"
                            class="form-control"
                            placeholder="descripcion superior"
                            aria-label="descripcion superior"
                            name="superior"
                            aria-describedby="basic-addon-search31"
                            wire:model="slider.superior"
                        />
                    </div>
                    
                    <div class="input-group input-group-merge">
                        <label class="input-group-text">Título</label>
                        <input
                            type="text"
                            maxlength="250"
                            class="form-control"
                            placeholder="titulo"
                            aria-label="titulo"
                            name="titulo"
                            aria-describedby="basic-addon-search31"
                            wire:model="slider.titulo"
                        />
                    </div>
                    
                    <div class="input-group input-group-merge">
                        <label class="input-group-text">Nombre</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Nombre"
                            aria-label="Nombre"
                            name="descripcion"
                            aria-describedby="basic-addon-search31"
                            wire:model="slider.nombre"
                        />
                    </div>
                    
                    <div class="input-group input-group-merge">
                        <label class="input-group-text">Descripción</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Descripción"
                            aria-label="Descripción"
                            name="descripcion"
                            aria-describedby="basic-addon-search31"
                            wire:model="slider.descripcion"
                        />
                    </div>
                    
                    <div class="input-group input-group-merge">
                        <label class="input-group-text">Texto del Botón</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Texto del Botón"
                            aria-label="Texto del Botón"
                            name="boton_texto"
                            aria-describedby="basic-addon-search31"
                            wire:model="slider.boton_texto"
                        />
                    </div>

                    <div class="input-group input-group-merge">
                        <label class="input-group-text">Link</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Link"
                            aria-label="Link"
                            name="link"
                            aria-describedby="basic-addon-search31"
                            wire:model="slider.link"
                        />
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    
                    {{--<div class="input-group input-group-merge">
                    <span class="input-group-text">With textarea</span>
                    <textarea class="form-control" aria-label="With textarea"></textarea>
                    </div> --}}

                    
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-header">Imagen</h5>
                    <label for="imagen-file">
                        @if(is_string($imagen))
                            <img src="{{ $imagen }}" class="w-100" alt="">
                        @else    
                            <img src="{{ $imagen ? $imagen->temporaryUrl() : '' }}" class="w-100" alt="">
                        @endif
                    </label>
                </div>
            </div>  
        </form>
    @endif
</div>
