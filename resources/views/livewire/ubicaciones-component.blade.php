<div>
    @include('includes.mensajes')
    @if($modo == 'lista')
      <div class="row mb-4">
          <div class="col">
              {{-- <button class="btn btn-primary" wire:click.prevent="$set('modo' , 'edit')">Crear Nueva</button> --}}
          </div>
          <div class="col-3">
            {{-- <input type="text" class="form-control" wire:model="buscar" placeholder="Buscar"> --}}
          </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="card mb-4">
            <div class="card-body">
              <form action="#" wire:submit.prevent="guardarOpcion">
                <div class="row">
                  <div class="col-md-8">
                    Monto mínimo para envío gratis: 
                  </div>
                  <div class="col-md-2">
                    <input type="number" min="0" step="any" wire:model="envioGratis" class="form-control form-control-sm" placeholder="Monto Mínimo">
                  </div>
                  <div class="col-md-2">
                    <button class="btn btn-sm btn-primary w-100" type="submit">Guardar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    
      <div class="row">
        <div class="col-md-12">
          <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between mb-4">
              <h6>Ubicaciones</h6>
              <select name="" id="" class="w-50 form-control-sm form-control" wire:model="tipo" >
                <option value="">Todos</option>
                <option value="1">Provincias</option>
                <option value="2">Distritos</option>
                <option value="3">Corregimientos</option>
                <option value="4">Barrios</option>
              </select>
              <button class="btn btn-sm btn-primary" wire:click.prevent="$set('modo' , 'edit')">Crear Nueva</button>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 table-hover">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Envío</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ubicacion Principal</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipo</th>
                      
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Registrado</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>

                      @foreach ($ubicaciones as $ubicacion)
                        
                        <tr>
                            <td>
                                <a href="#" wire:click.prevent="edit({{ $ubicacion->id }})">
                                    {{ $ubicacion->nombre }}
                                </a>
                            </td>
                            <td>
                                {{ $ubicacion->envio }}
                            </td>
                            <td>
                                {{ $ubicacion->padre ? $ubicacion->padre->nombre : '' }}
                            </td>
                            
                            <td>
                                <a href="#" wire:click.prevent="edit({{ $ubicacion->id }})">
                                    {{ $ubicacion->tipo() }}
                                </a>
                            </td>
                            
                            <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">{{ $ubicacion->created_at->format('d/m/Y') }}</span>
                            </td>
                            <td class="d-flex justify-content-between">
                              <a href="#" wire:click.prevent="edit({{ $ubicacion->id }})" class="text-primary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit ubicacion">
                                Editar
                              </a>
                               | 
                              <a href="#" wire:click.prevent="delete({{ $ubicacion->id }})" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit ubicacion">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                </svg>
                              </a>
                            </td>
                        </tr>
                        
                      @endforeach
                    
                  </tbody>
                </table>
              </div>

              <div class="row">
                <div class="col d-flex justify-content-center">
                  <div>{{ $ubicaciones->links() }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @else
      <div class="row">
        
        {{-- <div class="col-md-4">
          <div class="card mb-4">
            <div class="card-header">Imagen</div>
            <div class="card-body" style="background-color:rgb(221, 221, 221)">
              <div class="row">
                <div class="col-md-12">
                  @if($imagen)
                    <img src="{{ is_string($imagen) ? $imagen : $imagen->temporaryUrl() }}" class="img-fluid">
                  @else
                    <div class="text-center">
                      <img src="{{ asset('iso-meitanu.png') }}" style="max-width: 50%" class="img-fluid" alt="">
                    </div>
                  @endif
                  <input type="file" wire:model="imagen" class="mt-4">
                </div>
              </div>
            </div>
          </div>
        </div> --}}
        
        <div class="col-md-8">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>{{ $ubicacionId ? 'Editar' : 'Crear'}} Ubicacion</h6>
            </div>
            <div class="card-body pt-0 pb-2">
              <form action="#" wire:submit.prevent="guardar">
                <div class="row mb-4">
                  
                  {{-- <div class="col-md-4 mt-2">
                    <label for="">Ubicacion Principal</label>
                    <select class="form-control" wire:model="ubicacion.padre_id">
                      <option value="">Sin ubicacion Principal</option>
                        @foreach($ubicacionesPadre as $ubicacionPadre)
                          <option value="{{ $ubicacionPadre->id }}">{{ $ubicacionPadre->nombre }} - {{ $ubicacionPadre->tipo() }}</option>
                        @endforeach
                    </select>
                  </div> --}}

                  <div class="col-md-4 mt-2">
                    <label for="">Nombre</label>
                    <input type="text" wire:model="ubicacion.nombre" class="form-control">
                  </div>
                  
                  {{-- <div class="col-md-4 mt-2">
                    <label for="">Empresa de Transporte</label>
                    <input type="text" wire:model="ubicacion.transportista" class="form-control">
                  </div> --}}

                  <div class="col-md-8 mt-2">
                    <label for="">Descripcion</label>
                    <input type="text" wire:model="ubicacion.descripcion" class="form-control">
                  </div>
                  
                  {{-- <div class="col-md-4 mt-2">
                    <label for="">Costo de Envío</label>
                    <input type="number" step="any" wire:model="ubicacion.envio" class="form-control">
                  </div> --}}
                  
                  {{-- <div class="col-md-2 mt-2">
                    <label for="">Tipo de Envío</label>
                    <select name="tipo_envio" wire:model="ubicacion.tipo_envio" id="" class="form-control">
                      <option value="">No definido</option>
                      <option value="1">Motorizado</option>
                      <option value="2">Domicilio</option>
                    </select>
                  </div> --}}

                  {{-- <div class="col-md-2 mt-2">
                    <label for="">Latitud</label>
                    <input type="number" step="any" wire:model="ubicacion.lat" class="form-control">
                  </div> --}}
                  
                  {{-- <div class="col-md-2 mt-2">
                    <label for="">Longitud</label>
                    <input type="number" step="any" wire:model="ubicacion.lon" class="form-control">
                  </div> --}}

                </div>

                <div class="row">
                  <div class="col d-flex justify-content-end">
                    <a href="#" wire:click.prevent="resetForm" class="btn btn-secondary mx-2">Volver al Listado</a>
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                      <span style="display: none" wire:loading>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      </span>
                      Guardar
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          @if($ubicacionId && App\Models\Ubicacion::find($ubicacionId)->hijos->count())
            <div class="card mb-4">
              <div class="card-header">
                Empresas de Transporte
              </div>
              <div class="card-body p-0">
                {{-- <label for="" class="w-100">Disponible para las tiendas:</label> --}}
                @livewire('transporte-component' , ['ubicacionId' => $ubicacionId])
              </div>
            </div>
          @endif

        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              Disponible para las tiendas:
            </div>
            <div class="card-body p-0">
              {{-- <label for="" class="w-100">Disponible para las tiendas:</label> --}}
              <div class="list-group list-group-flush rounded">
                @foreach(tiendasDisponibles() as $key => $tienda)
                  <a href="#" class="d-flex justify-between list-group-item list-group-item-action {{ in_array($tienda->slug , $tiendas) ? 'active' : ''}} mr-2" wire:click.prevent="agregarTienda('{{ $tienda->slug }}')">
                    @if(in_array($tienda->slug , $tiendas))
                      <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-record-circle" viewBox="0 0 16 16">
                          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                          <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        </svg>
                      </div>
                    @else
                      <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        </svg>
                      </div>
                    @endif
                    <span>{{ $tienda->nombre }}</span>
                    
                    @if(in_array($tienda->slug , $tiendas))
                      <span>Si</span>
                    @else
                      <span>No</span>
                    @endif
                  </a>
                @endforeach
              </div>
            </div>
          </div>
          
          <div class="card mt-4">
            <div class="card-header pb-0">
                <h6>{{ App\Models\Ubicacion::find($ubicacionId)->nombreHijos() }}</h6>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @foreach(App\Models\Ubicacion::find($ubicacionId)->hijos as $hijo)
                        <a href="#" wire:click.prevent="edit({{ $hijo->id }})" class="list-group-item list-group-item-action">
                            {{ $hijo->nombre }}
                        </a>
                    @endforeach
                  </div>
            </div>
        </div>
        </div>


      </div>
    @endif

</div>
