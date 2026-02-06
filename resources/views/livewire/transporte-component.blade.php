<div>

    @if($modo == 'lista')
    <div class="card-body pt-0">
        <ul class="list-group list-group-flush">
            @foreach($transportes as $transporteLista)
                <li class="list-group-item d-flex justify-between">
                    <span style="width: 50%">{{ $transporteLista->nombre }}</span>
                    <span >{{ $transporteLista->tipo() }}</span>
                    <div>
                        <span class="mr-2">${{ $transporteLista->precio }}</span>
                        <a href="#" class="btn btn-sm btn-primary" wire:click.prevent="edit({{ $transporteLista->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                              </svg>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-danger"  wire:click.prevent="delete({{ $transporteLista->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                              </svg>
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
        <a href="#" class="btn btn-outline-primary w-100" wire:click.prevent="$set('modo' , 'edit')">Agregar transportista</a>
    </div>
    

    @endif
    @if($modo == 'edit')
        <div class="card-body pt-0">
            <div class="row">
                <form action="#" wire:submit.prevent="save">

                    <div class="row">
                            
                        <div class="col-12 mb-4">
                            <label for="">{{ $transporteId ? 'Editar' : 'Crear' }} Transportista</label>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" wire:model="transporte.nombre">
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <label for="">Tipo</label>
                            <select name="" id="" class="form-control" wire:model="transporte.tipo">
                                <option value="">Seleccione</option>
                                <option value="2">Delivery</option>
                                <option value="3">Encomienda</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-4">
                            <label for="">Precio</label>
                            <input type="number" step="any" class="form-control" wire:model="transporte.precio">
                        </div>

                        <div class="col-12">
                            @include('includes.mensajes')
                            <button class="btn btn-primary w-100 mb-2">Registrar</button>
                            <a class="btn btn-outline-primary w-100" wire:click.prevent="resetForm">Volver</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    @endif

    
</div>
