<div>
    @if($modo == 'lista')
        <!-- Bootstrap Table with Header - Light -->
        <div class="card">
            <div class="d-flex justify-content-between">
                <h5 class="card-header">Lista de Clientes</h5>
                <div class="d-flex align-items-center p-4">
                    <button wire:click.prevent="$set('modo' , 'edit')" class="btn btn-sm btn-primary">Nuevo</button>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Cédula</th>
                        <th>Teléfono</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($clientes as $cliente)
                            <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ Str::title($cliente->nombreCompleto()) }}</strong></td>
                            <td>{{ $cliente->email }}</td>
                            <td>
                                {{ $cliente->cedula }}
                            </td>
                            <td>
                                {{ $cliente->telefono }}
                            </td>
                            <td>
                                <a class="" href="#" wire:click.prevent="edit({{ $cliente->id }})"
                                    ><i class="bx bx-edit-alt me-1"></i> Editar</a>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $clientes->links() }}
            </div>
        </div>
        <!-- Bootstrap Table with Header - Light -->
    @endif

    @if( $modo == 'edit')
        <form action="#" wire:submit.prevent="save">
            @include('includes.mensajes')
            <div class="card mb-4">
                <div class="d-flex justify-content-between">
                    <h5 class="card-header">{{ $clienteId ? 'Editar' : 'Crear' }} Cliente</h5>
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
                            aria-describedby="basic-addon-search31"
                            wire:model="cliente.nombre"
                        />
                    </div>
                    
                    <div class="input-group input-group-merge">
                        <label class="input-group-text">Apellido</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Apellido"
                            aria-label="Apellido"
                            aria-describedby="basic-addon-search31"
                            wire:model="cliente.apellido"
                        />
                    </div>
                    
                    <div class="input-group input-group-merge">
                        <label class="input-group-text">Cédula</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Cédula"
                            aria-label="Cédula"
                            aria-describedby="basic-addon-search31"
                            wire:model="cliente.cedula"
                        />
                    </div>
                    
                    <div class="input-group input-group-merge">
                        <label class="input-group-text">Telêfono</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Telêfono"
                            aria-label="Telêfono"
                            aria-describedby="basic-addon-search31"
                            wire:model="cliente.telefono"
                        />
                    </div>

                    <div class="row">
                        <div class="col-6 form-group pr-1 mb-4">
                            <select name="" id="" wire:model="cliente.provincia" class="form-control">
                                <option value="">Provincia</option>
                                @foreach(getProvincias() as $ubicacion)
                                <option value="{{ $ubicacion->nombre }}">{{ $ubicacion->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 form-group pr-1 mb-4">
                        <select name="" id=""  class="form-control" wire:model="cliente.distrito">
                            <option value="">Distrito</option>
                            @if(isset($cliente['provincia']) && $cliente['provincia'] && $cliente['provincia'] != '')
                                @foreach(getDistritos($cliente['provincia']) as $ubicacion)
                                <option value="{{ $ubicacion->nombre }}">{{ $ubicacion->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        </div>
                        <div class="col-6 form-group pr-1 mb-4">
                        <select name="" id=""  class="form-control" wire:model="cliente.corregimiento">
                            <option value="">Corregimiento</option>
                            @if(isset($cliente['distrito']) && $cliente['distrito'] && $cliente['distrito'] != '')
                                @foreach(getCorregimientos($cliente['distrito']) as $ubicacion)
                                <option value="{{ $ubicacion->nombre }}">{{ $ubicacion->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        </div>
                        <div class="col-6 form-group pr-1 mb-4">
                        <select name="" id=""  class="form-control" wire:model="cliente.corregimiento">
                            <option value="">Barriada</option>
                            @if(isset($cliente['corregimiento']) && $cliente['corregimiento'] && $cliente['corregimiento'] != '')
                                @foreach(getBarrios($cliente['corregimiento']) as $ubicacion)
                                <option value="{{ $ubicacion->nombre }}">{{ $ubicacion->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        </div>
                    </div>
                    
                    <div class="input-group input-group-merge">
                        <label class="input-group-text">Dirección</label>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Dirección"
                            aria-label="Dirección"
                            aria-describedby="basic-addon-search31"
                            wire:model="cliente.direccion"
                        />
                    </div>
                    
                    <div class="input-group input-group-merge">
                        <label class="input-group-text">Email</label>
                        <input
                            type="email"
                            class="form-control"
                            placeholder="Email"
                            aria-label="Email"
                            aria-describedby="basic-addon-search31"
                            wire:model="cliente.email"
                        />
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
