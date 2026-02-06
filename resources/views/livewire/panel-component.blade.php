<div>
   
     <!-- Service Details Page Start -->
     <div class="container margin_30 container pt-1">
         
     <section class="my-4">
        <div class="container">
           <div class="row">
              <div class="col-lg-4">
                 
                 <div class="">
	                    
	                    <div class="filter_type version_2">
	                        <h4><a href="#filter_1" data-bs-toggle="collapse" class="opened">Secciones</a></h4>
	                        <div class="collapse show" id="filter_1">
	                            <ul>
	                                <li>
                                       <a href="#" class="text-black" wire:click.prevent="$set('vista' , 'datos')">Datos Personales</a>
	                                </li>
                                   <li>
                                       <a href="#" class="text-black" wire:click.prevent="$set('vista' , 'compras')">Historial de Compra</a>
                                    </li>
                                   <form method="POST" action="{{ route('logout') }}" class="p-0 m-0">
                                          @csrf
                                          <li><a href="{{ route('logout') }}" class="text-black" onclick="event.preventDefault();
                                             this.closest('form').submit();">Cerrar Sesion</a></li>
                                    </form>
	                            </ul>
	                        </div>
	                        <!-- /filter_type -->
	                    </div>
	                </div>
              </div>
              <div class="col-lg-8">
                 <div class="">
                  <div class="filter_type version_2">
                     <h4 class="mb-4">{{ Str::title($vista) }}</h4>
                        @if($vista == 'datos')
                           <form action="#" wire:submit.prevent="guardarPerfil">
                              @csrf
                              <div class="row">

                                 <div class="col-md-4 mb-4">
                                    <label for="">Nombre</label>
                                    <input type="text" class="form-control" wire:model="user.name">
                                 </div>

                                 <div class="col-md-4 mb-4">
                                    <label for="">Apellido</label>
                                    <input type="text" class="form-control" wire:model="user.apellido">
                                 </div>

                                 <div class="col-md-4 mb-4">
                                    <label for="">Cédula</label>
                                    <input type="text" class="form-control" wire:model="user.cedula">
                                 </div>

                                 <div class="col-md-2 mb-4">
                                    <label for="">Código</label>
                                    <input type="text" class="form-control" wire:model="user.codigo_telefono">
                                 </div>
                                 <div class="col-md-4 mb-4">
                                    <label for="">Teléfono</label>
                                    <input type="text" class="form-control" wire:model="user.telefono">
                                 </div>

                                 <div class="col-md-6 mb-4">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" wire:model="user.email" disabled>
                                 </div>
                                 
                                 <div class="col-md-6 mb-4">
                                    <label for="">Cambiar Contraseña</label>
                                    <input type="password" class="form-control" wire:model="user.password">
                                 </div>

                                 <div class="col-md-6 mb-4">
                                    <label for="">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" wire:model="user.fecha_nacimiento">
                                 </div>

                                 
                                 <div class="col-6 form-group pr-1">
                                    <select name="" id="" wire:model="user.provincia" class="form-control">
                                       <option value="">Provincia</option>
                                       @foreach(getProvincias() as $ubicacion)
                                       <option value="{{ $ubicacion->nombre }}">{{ $ubicacion->nombre }}</option>
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="col-6 form-group pr-1">
                                    <select name="" id=""  class="form-control" wire:model="user.distrito">
                                       <option value="">Distrito</option>
                                       @if(isset($user['provincia']) && $user['provincia'] && $user['provincia'] != '')
                                          @foreach(getDistritos($user['provincia']) as $ubicacion)
                                          <option value="{{ $ubicacion->nombre }}">{{ $ubicacion->nombre }}</option>
                                          @endforeach
                                       @endif
                                    </select>
                                 </div>
                                 <div class="col-6 form-group pr-1">
                                    <select name="" id=""  class="form-control" wire:model="user.corregimiento">
                                       <option value="">Corregimiento</option>
                                       @if(isset($user['distrito']) && $user['distrito'] && $user['distrito'] != '')
                                          @foreach(getCorregimientos($user['distrito']) as $ubicacion)
                                          <option value="{{ $ubicacion->nombre }}">{{ $ubicacion->nombre }}</option>
                                          @endforeach
                                       @endif
                                    </select>
                                 </div>
                                 <div class="col-6 form-group pr-1">
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
                                    <label for="">Dirección</label>
                                    <input type="text" class="form-control" wire:model="user.direccion">
                                 </div>
                                 
                                 <div class="col-md-12 mb-4">
                                    @include('includes.mensajes')
                                    <button class="btn btn-primary">Guardar</button>
                                 </div>

                              </div>
                           </form>
                        @endif
                        @if($vista == 'compras')
                           <div class="table-responsive">
                              <table class="table table-hover">
                                 <thead>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Tienda origen</th>
                                    <th>Compra</th>
                                    <th>Envío</th>
                                    <th>Monto</th>
                                    <th>Estatus</th>
                                 </thead>
                                 <tbody>
                                    @foreach(auth()->user()->comprasLimit(30) as $compra)
                                    <tr>
                                       <td>{{ $compra->id }}</td>
                                       <td>{{ $compra->created_at->format('d/m/Y H:i') }}</td>
                                       <td>{{ $compra->tienda() }}</td>
                                       <td>{{ $compra->itemsNombres() }}</td>
                                       <td>${{ number_format($compra->envio , 2) }}</td>
                                       <td>${{ number_format($compra->precioConImpuesto() , 2) }}</td>
                                       <td>{{ $compra->estatus() }}</td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                        @endif
                  </div>
                 </div>
              </div>
           </div>
        </div>
     </section>
     <!-- Service Details Page End -->
</div>
