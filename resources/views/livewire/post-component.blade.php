<div>
    @if($modo == 'lista')
        <!-- Bootstrap Table with Header - Light -->
        <div class="card">
            <div class="d-flex justify-content-between">
                <h5 class="card-header">Lista de posts</h5>
                <div class="d-flex align-items-center p-4">
                    <select class="form-control form-control-sm mr-2 px-4" wire:model="categoriaId">
                        <option value="">Todas las Categorias</option>
                        @foreach(categoriasPublicas() as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                        @endforeach
                    </select>
                    <button wire:click.prevent="nuevoContenido" class="btn btn-sm btn-primary">Nuevo</button>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                    <tr>
                        <th></th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estatus</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($posts as $post)
                            <tr>
                                <td><img src="{{ $post->imagen() }}" style="width:30px;" alt=""></td>
                                <td>{{ $post->id_post }}</td>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ Str::title($post->nombre) }}</strong></td>
                                <td>
                                    {{ Str::limit($post->descripcion , 30) }}
                                </td>
                                <td>
                                    <a href="#" wire:click.prevent="cambiarEstatus({{ $post->id }})">{{ $post->estatus() }}</a>
                                </td>
                                
                                <td>
                                    <a class="" href="#" wire:click.prevent="edit({{ $post->id }})"
                                        ><i class="bx bx-edit-alt me-1"></i> Editar</a>

                                    <a class="text-danger" href="#" wire:click.prevent="delete({{ $post->id }})"
                                        ><i class="bx bx-trash me-1"></i> Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
        <!-- Bootstrap Table with Header - Light -->
    @endif

    @if( $modo == 'edit')
        <form action="#" wire:submit.prevent="save">
            @include('includes.mensajes')
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
                            {{-- <div wire:loading wire:target="imagen">
                                <div class="d-flex align-items-center w-100">
                                    <strong>Cargando Imagen...</strong>
                                    <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                                </div>
                            </div> --}}
                            <div class="px-2">
                                <h4 class="mt-4 mb-0">{{ isset($post['nombre']) ? $post['nombre'] : '' }}</h4>
                                
                                <p>{{ isset($post['precio']) ? '$'.$post['precio'] : '' }}</p>
                             
                            </div>
                        </div>
                    </div>


                    
                </div>    
                
                <div class="col-md-9">    
                    <div class="card mb-4">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-header">{{ $postId ? 'Editar' : 'Crear' }} post</h5>
                            <div class="d-flex align-items-center p-4">
                                <a wire:click.prevent="resetForm" class="btn btn-sm btn-primary text-white">Volver</a>
                            </div>
                        </div>
                        <div class="card-body demo-vertical-spacing demo-only-element">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <div class="input-group input-group-merge">
                                        <label class="input-group-text">Imagen</label>
                                        <input
                                            type="file"
                                            id="imagen-file"
                                            class="form-control"
                                            placeholder="Imagen"
                                            aria-label="Imagen"
                                            aria-describedby="basic-addon-search31"
                                            wire:model.defer="imagen"
                                        />
                                    </div>
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
                                            wire:model.defer="post.nombre"
                                        />
                                    </div>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">Categoría</span>
                                        <select class="form-control" aria-label="Descripcion" wire:model.defer="post.categoria_id">
                                            <option value="">Seleccione</option>
                                            @foreach(categoriasPublicas() as $categoria)
                                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>

                                
                               
                                <div class="col-md-12 mb-4">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">Tags de búsqueda</span>
                                        <textarea class="form-control" aria-label="Tags" wire:model.defer="post.tags"></textarea>
                                    </div> 
                                </div>
                                
                                <div class="col-md-12 mb-4">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">Descripción corta</span>
                                        <textarea class="form-control" aria-label="Descripcion" wire:model.defer="post.descripcion"></textarea>
                                    </div> 
                                </div>

                                <div class="col-md-12 mb-4">
                                    <div wire:ignore>
                                        <div class="">
                                            <span class="">Contenido</span>
                                            <textarea class="form-control" id="editor-html" aria-label="Descripcion" wire:model.defer="post.contenido"></textarea>
                                        </div> 
                                    </div> 
                                </div>
                                
                            </div>
                            
                            

                            
                            
                            
                            
                            <button class="btn btn-primary" type="submit" wire:loading.attr="disabled">Guardar</button>
                            {{--<div class="input-group input-group-merge">
                            <span class="input-group-text">With textarea</span>
                            <textarea class="form-control" aria-label="With textarea"></textarea>
                            </div> --}}

                            
                        </div>
                    </div>
                   
                </div>
            </div>
        </form>
    @endif
</div>
