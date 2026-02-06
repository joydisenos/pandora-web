<div>
    @if($modo == 'lista')
        <!-- Bootstrap Table with Header - Light -->
        <div class="card">
            <div class="d-flex justify-content-between">
                <h5 class="card-header">Lista de Usuarios</h5>
                <div class="d-flex align-items-center p-4">
                    <a wire:click.prevent="$set('modo' , 'edit')" class="btn btn-sm btn-primary text-white">Nuevo</a>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Registrado</th>
                        <th>Perfil</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($users as $user)
                            <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ Str::title($user->name) }}</strong></td>
                            <td>{{ $user->email }}</td>
                            <td>
                                {{ $user->created_at->format('d/m/Y') }}
                            </td>
                            <td>
                                <img src="{{ $user->profile_photo_url }}" style="width:20px" class="img-fluid" alt="">
                            </td>
                            <td>
                                <a class="" href="#" wire:click.prevent="edit({{ $user->id }})"
                                    ><i class="bx bx-edit-alt me-1"></i> Editar</a>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        </div>
        <!-- Bootstrap Table with Header - Light -->
    @endif

    @if( $modo == 'edit')
    <form action="#" wire:submit.prevent="save">
        @include('includes.mensajes')
        <div class="card mb-4">
            <div class="d-flex justify-content-between">
                <h5 class="card-header">{{ $userId ? 'Editar' : 'Crear' }} Usuario</h5>
                <div class="d-flex align-items-center p-4">
                    <a wire:click.prevent="resetForm" class="btn btn-sm btn-primary text-white">Volver</a>
                </div>
            </div>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="input-group input-group-merge">
                            <label class="input-group-text">Nombre</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Nombre"
                                aria-label="Nombre"
                                aria-describedby="basic-addon-search31"
                                wire:model="user.name"
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
                                wire:model="user.apellido"
                            />
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="input-group input-group-merge">
                            <label class="input-group-text">Email</label>
                            <input
                                type="email"
                                class="form-control"
                                placeholder="Email"
                                aria-label="Email"
                                aria-describedby="basic-addon-search31"
                                wire:model="user.email"
                            />
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="input-group input-group-merge">
                            <label class="input-group-text">Contraseña</label>
                            <input
                                type="password"
                                class="form-control"
                                placeholder="Contraseña"
                                aria-label="Contraseña"
                                aria-describedby="basic-addon-search31"
                                wire:model="user.password"
                            />
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-4">
                        <div class="input-group input-group-merge">
                            <label class="input-group-text">Teléfono</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Teléfono"
                                aria-label="Teléfono"
                                aria-describedby="basic-addon-search31"
                                wire:model="user.telefono"
                            />
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-4">
                        <div class="input-group input-group-merge">
                            <label class="input-group-text">Fecha de Nacimiento</label>
                            <input
                                type="date"
                                class="form-control"
                                placeholder="Fecha de Nacimiento"
                                aria-label="Fecha de Nacimiento"
                                aria-describedby="basic-addon-search31"
                                wire:model="user.fecha_nacimiento"
                            />
                        </div>
                    </div>
                    
                    <div class="col-6 form-group pr-1 mb-4">
                        <select name="" id="" wire:model="user.provincia" class="form-control">
                           <option value="">Provincia</option>
                           @foreach(getProvincias() as $ubicacion)
                           <option value="{{ $ubicacion->nombre }}">{{ $ubicacion->nombre }}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="col-6 form-group pr-1 mb-4">
                        <select name="" id=""  class="form-control" wire:model="user.distrito">
                           <option value="">Distrito</option>
                           @if(isset($user['provincia']) && $user['provincia'] && $user['provincia'] != '')
                              @foreach(getDistritos($user['provincia']) as $ubicacion)
                              <option value="{{ $ubicacion->nombre }}">{{ $ubicacion->nombre }}</option>
                              @endforeach
                           @endif
                        </select>
                     </div>
                     <div class="col-6 form-group pr-1 mb-4">
                        <select name="" id=""  class="form-control" wire:model="user.corregimiento">
                           <option value="">Corregimiento</option>
                           @if(isset($user['distrito']) && $user['distrito'] && $user['distrito'] != '')
                              @foreach(getCorregimientos($user['distrito']) as $ubicacion)
                              <option value="{{ $ubicacion->nombre }}">{{ $ubicacion->nombre }}</option>
                              @endforeach
                           @endif
                        </select>
                     </div>
                     <div class="col-6 form-group pr-1 mb-4">
                        <select name="" id=""  class="form-control" wire:model="user.corregimiento">
                           <option value="">Barriada</option>
                           @if(isset($user['corregimiento']) && $user['corregimiento'] && $user['corregimiento'] != '')
                              @foreach(getBarrios($user['corregimiento']) as $ubicacion)
                              <option value="{{ $ubicacion->nombre }}">{{ $ubicacion->nombre }}</option>
                              @endforeach
                           @endif
                        </select>
                     </div>
                    
                    <div class="col-md-12 mb-4">
                        <div class="input-group input-group-merge">
                            <label class="input-group-text">Dirección</label>
                            <textarea
                                class="form-control"
                                placeholder="Dirección"
                                aria-label="Dirección"
                                aria-describedby="basic-addon-search31"
                                wire:model="user.direccion"
                            ></textarea>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="input-group input-group-merge">
                            <label class="input-group-text">Rol</label>
                            <select
                                class="form-control"
                                placeholder="Rol de Usuario"
                                aria-label="Rol de Usuario"
                                aria-describedby="basic-addon-search31"
                                wire:model="rol"
                            >
                                <option value="">Cliente</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    
                    
                </div>
                

                <button class="btn btn-primary" type="submit">Guardar</button>
                {{--<div class="input-group input-group-merge">
                <span class="input-group-text">With textarea</span>
                <textarea class="form-control" aria-label="With textarea"></textarea>
                </div> --}}

                
            </div>
        </div>
    </form>
    @endif
</div>
