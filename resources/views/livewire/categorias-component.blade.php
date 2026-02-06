<div>
    @if($modo == 'lista')
        <!-- Bootstrap Table with Header - Light -->
        <div class="card">
            <div class="d-flex justify-content-between">
                <h5 class="card-header">Lista de Categorias</h5>
                <div class="d-flex align-items-center p-4">
                    <button wire:click.prevent="$set('modo' , 'edit')" class="btn btn-sm btn-primary">Nuevo</button>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Cat. Padre</th>
                        <th>Descripción</th>
                        {{-- <th>Impuesto</th> --}}
                        <th>Productos</th>
                        <th>Estatus</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($categorias as $categoria)
                            <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ Str::title($categoria->nombre) }}</strong></td>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ Str::title($categoria->catPrincipal()) }}</strong></td>
                            <td>{{ $categoria->descripcion }}</td>
                            {{-- <td>{{ $categoria->impuesto > 0 ? number_format($categoria->impuesto , 2) . '%' : '' }}</td> --}}
                            <td>{{ $categoria->productos->count() }}</td>
                            <td><a href="#" wire:click.prevent="cambiarEstatus({{ $categoria->id }})">{{ $categoria->estatus() }}</a></td>
                            <td>
                                <a class="" href="#" wire:click.prevent="edit({{ $categoria->id }})"
                                    ><i class="bx bx-edit-alt me-1"></i> Editar</a>
                                <a class="text-danger" href="#" wire:click.prevent="delete({{ $categoria->id }})"
                                    ><i class="bx bx-trash me-1"></i> Eliminar</a>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $categorias->links() }}
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
                            <h5 class="card-header">{{ $categoriaId ? 'Editar' : 'Crear' }} {{ $categoriaId && $categoria['padre_id'] ? 'Subcategoría' : 'Categoría'}}</h5>
                            <div class="d-flex align-items-center p-4">
                                <a wire:click.prevent="resetForm" class="btn btn-sm btn-primary text-white">Volver</a>
                            </div>
                        </div>
                        <div class="card-body demo-vertical-spacing demo-only-element">
                            {{-- <div class="input-group input-group-merge">
                                <label class="input-group-text">Categoría Padre</label>
                                <select
                                    class="form-control"
                                    placeholder="Categoría Padre"
                                    aria-label="Categoría Padre"
                                    name="padre_id"
                                    aria-describedby="basic-addon-search31"
                                    wire:model="categoria.padre_id"
                                >
                                    <option value="">N/A</option>
                                    @foreach(categoriasPublicas() as $cat)
                                        <option value="{{ $cat->id }}">{{ Str::title($cat->nombre) }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            
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
                                    wire:model="categoria.nombre"
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
                                    wire:model="categoria.descripcion"
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
                                    wire:model="categoria.impuesto"
                                />
                            </div> --}}
        
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            
                            {{--<div class="input-group input-group-merge">
                            <span class="input-group-text">With textarea</span>
                            <textarea class="form-control" aria-label="With textarea"></textarea>
                            </div> --}}
        
                            
                        </div>
                    </div>

                    @if( $categoriaId && $categoria['padre_id'] == null)
                        <div class="card mb-4">
                            <div class="card-body demo-vertical-spacing demo-only-element">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="mb-0">Subcategorías</h6>
                                    <a href="#" class="btn btn-sm btn-secondary" wire:click.prevent="crearSub({{ $categoriaId }})">Crear SubCategoría</a>
                                </div>
        
                                @if(count($subcategorias))
                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-sm">
                                            <thead class="table-light">
                                            <tr>
                                                <th>Nombre</th>
                                                <th class="text-end">Acción</th>
                                            </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                @foreach($subcategorias as $sub)
                                                    <tr>
                                                        <td>{{ Str::title($sub->nombre) }}</td>
                                                        <td class="text-end">
                                                            <a class="me-2" href="#" wire:click.prevent="edit({{ $sub->id }})">
                                                                <i class="bx bx-edit-alt me-1"></i>
                                                            </a>
                                                            <a class="text-danger" href="#" wire:click.prevent="delete({{ $sub->id }})">
                                                                <i class="bx bx-trash me-1"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="alert alert-secondary" role="alert">
                                        No hay subcategorías registradas.
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
