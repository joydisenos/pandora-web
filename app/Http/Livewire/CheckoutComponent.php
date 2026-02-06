<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cliente;
use App\Models\Orden;
use App\Models\Producto;
use App\Models\Ubicacion;
use App\Mail\OrderMail;
use App\Mail\OrderMailAdmin;
use App\Models\Transporte;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutComponent extends Component
{
    public $orden, $terminos , $email, $password , $remember , $userId , $mismaDireccion;

    protected $listeners = ['ordenar'];

    public function updatedOrdenProvinciaEnvio($val)
    {
        unset($this->orden['transporte']);
    }

    public function updatedOrdenRetiro($val)
    {
        $this->resetErrorBag();

        if($val < 2)
        {
            unset($this->orden['provincia_envio']);
            unset($this->orden['distrito_envio']);
            unset($this->orden['corregimiento_envio']);
            unset($this->orden['barrio_envio']);
            unset($this->orden['direccion_envio']);
            unset($this->orden['transporte']);
        }

        $this->mismaDireccion = null;
    }
    
    public function updatedMismaDireccion($val)
    {
        $this->resetErrorBag();

        if($val == 0)
        {
            if(!isset($this->orden['provincia']))
            {   
                return $this->addError('orden.provincia', 'Debe seleccionar una dirección principal');
            }
            
            if( getProvincias(currentTiendaSlug())->where('nombre' , $this->orden['provincia'])->count() == 0 )
            {   
                return $this->addError('orden.provincia', 'Esta dirección no está disponible para la tienda ' . currentTiendaName());
            }

            $this->orden['provincia_envio'] = isset($this->orden['provincia']) ? $this->orden['provincia'] : null;
            $this->orden['distrito_envio'] = isset($this->orden['distrito']) ? $this->orden['distrito'] : null;
            $this->orden['corregimiento_envio'] = isset($this->orden['corregimiento']) ? $this->orden['corregimiento'] : null;
            $this->orden['barrio_envio'] = isset($this->orden['barrio']) ? $this->orden['barrio'] : null;
            $this->orden['direccion_envio'] = isset($this->orden['direccion']) ? $this->orden['direccion'] : null;
        }else{
            unset($this->orden['provincia_envio']);
            unset($this->orden['distrito_envio']);
            unset($this->orden['corregimiento_envio']);
            unset($this->orden['barrio_envio']);
            unset($this->orden['direccion_envio']);
            unset($this->orden['transporte']);
        }
    }
    
    public function transportistas()
    {
        if(isset($this->orden['provincia_envio']) && $this->orden['provincia_envio'] != '')
        {
            $ubicacion = Ubicacion::where('nombre' , $this->orden['provincia_envio'])
                                    ->where('tipo' , 1)
                                    ->first();

            // if($ubicacion->transportista)
            // {
                $transportes = Transporte::where('estatus' , 1)
                                    ->where('ubicacion_id' , $ubicacion->id)
                                    ->where('tipo' , $this->orden['retiro'])
                                    ->orderBy('tipo')
                                    ->orderBy('nombre')
                                    ->get();

                return $transportes;
            // }

            return null;
        }

        return null;
    }

    public function mount()
    {
        $user = auth()->user();

        if($user)
        {
            $this->orden['nombre'] = $user->name;
            $this->orden['apellido'] = $user->apellido;
            $this->orden['direccion'] = $user->direccion;
            $this->orden['provincia'] = $user->provincia;
            $this->orden['distrito'] = $user->distrito;
            $this->orden['corregimiento'] = $user->corregimiento;
            $this->orden['barrio'] = $user->barrio;
            $this->orden['cedula'] = $user->cedula;
            $this->orden['telefono'] = $user->telefono;
            $this->orden['codigo_telefono'] = $user->codigo_telefono;
            $this->orden['email'] = $user->email;
            $this->userId = $user->id;
        }


            $this->orden['impuesto'] = opcionSlug('impuesto') ? opcionSlug('impuesto') : 0;
            $this->orden['retiro'] = 1;
            $this->orden['contacto'] = "Correo Electrónico";
            $this->orden['contacto_horario'] = null;
    }

    public function render()
    {
        $impuestoProd = 0;
        
        if($this->userId)
        {
            \Cart::session($this->userId);
        }

        $items = \Cart::getContent();
        foreach ($items as $key => $itm) {
            $prod = $itm->associatedModel;
            $impuestoProd += $prod->precioImpuesto();
        }
        $subtotal = $this->subtotal();
        $impuesto = $this->impuesto();
        // $total = $subtotal + $impuesto + $impuestoProd + $this->envio();
        $total = $subtotal + $impuesto + $this->envio();
        
        $data = [
            'items' => $items,
            'subtotal' => $subtotal,
            'impuesto' => $impuesto,
            'impuestoProd' => $impuestoProd,
            'total' => $total,
        ];

        return view('livewire.checkout-component' , $data);
    }

    public function impuesto()
    {
        $total = 0;
        foreach(\Cart::getContent() as $item)
        {
            $total += $this->totalImpuesto($item);
        }

        return $total;
    }

    public function totalImpuesto($item)
    {
        $total = $item['price'] * $item['quantity'];
        $impuesto = $total * ($item->associatedModel->impuesto() / 100);

        return $impuesto;
    }

    public function subTotal()
    {
        return \Cart::getSubtotal();
    }

    public function ordenar($estatus = 1)
    {
        $this->resetErrorBag();

        if(count($this->items()) < 1)
        {
            return true;
        }

        $this->validate([
            // 'terminos' => 'accepted',
            'orden.nombre' => 'required',
            'orden.apellido' => 'required',
            'orden.cedula' => 'required',
            'orden.direccion' => 'required',
            'orden.telefono' => 'required',
            // 'orden.provincia' => 'required',
            // 'orden.distrito' => 'required',
            // 'orden.retiro' => 'required',
            // 'orden.codigo_telefono' => 'required',
            'orden.email' => 'required',
            // 'orden.tipo_pago' => 'required',
        ]);

        // validaciones para envios a domicilio
        if($this->orden['retiro'] == 2 || $this->orden['retiro'] == 3)
        {
            if($this->mismaDireccion == 0)
            {
                $this->orden['provincia_envio'] = isset($this->orden['provincia']) ? $this->orden['provincia'] : null;
                $this->orden['distrito_envio'] = isset($this->orden['distrito']) ? $this->orden['distrito'] : null;
                $this->orden['corregimiento_envio'] = isset($this->orden['corregimiento']) ? $this->orden['corregimiento'] : null;
                $this->orden['barrio_envio'] = isset($this->orden['barrio']) ? $this->orden['barrio'] : null;
                $this->orden['direccion_envio'] = isset($this->orden['direccion']) ? $this->orden['direccion'] : null;
            }

            $this->validate([
                'orden.provincia_envio' => 'required',
                'orden.distrito_envio' => 'required',
                'orden.direccion_envio' => 'required',
                'orden.transporte' => 'required',
            ]);

            if( getProvincias(currentTiendaSlug())->where('nombre' , $this->orden['provincia_envio'])->count() == 0 )
            {   
                return $this->addError('orden.provincia', 'Esta dirección no está disponible para la tienda ' . currentTiendaName());
            }
        }

        if (!preg_match("/^[0-9-]+$/", $this->orden['cedula'])) {
            return $this->addError('orden.cedula', 'Sólo debe tener caracteres numéricos o guiones.');
        }

        if(auth()->user())
        {
            $this->orden['user_id'] = auth()->user()->id;
        }

        $cliente = Cliente::where('cedula' , $this->orden['cedula'])->first();

        if(!$cliente)
        {
            $cliente = Cliente::create([
                'nombre' => $this->orden['nombre'],
                'apellido' => $this->orden['apellido'],
                'cedula' => $this->orden['cedula'],
                'direccion' => $this->orden['direccion'],
                'provincia' => isset($this->orden['provincia']) ? $this->orden['provincia'] : null,
                'distrito' => isset($this->orden['distrito']) ? $this->orden['distrito'] : null,
                'corregimiento' => isset($this->orden['corregimiento']) ? $this->orden['corregimiento'] : null,
                'barrio' => isset($this->orden['barrio']) ? $this->orden['barrio'] : null,
                'codigo_telefono' => isset($this->orden['codigo_telefono']) ? $this->orden['codigo_telefono'] : null,
                'telefono' => $this->orden['telefono'],
                'email' => $this->orden['email'],
            ]);
        }else{
            $cliente->update([
                'nombre' => $this->orden['nombre'],
                'apellido' => $this->orden['apellido'],
                'cedula' => $this->orden['cedula'],
                'direccion' => $this->orden['direccion'],
                'provincia' => isset($this->orden['provincia']) ? $this->orden['provincia'] : null,
                'distrito' => isset($this->orden['distrito']) ? $this->orden['distrito'] : null,
                'corregimiento' => isset($this->orden['corregimiento']) ? $this->orden['corregimiento'] : null,
                'barrio' => isset($this->orden['barrio']) ? $this->orden['barrio'] : null,
                'telefono' => $this->orden['telefono'],
                'codigo_telefono' => isset($this->orden['codigo_telefono']) ? $this->orden['codigo_telefono'] : null,
                'email' => $this->orden['email'],
            ]);
        }
        
        $authUser = auth()->user();
        
        if($authUser)
        {
            $authUser->update([
                'name' => $this->orden['nombre'],
                'apellido' => $this->orden['apellido'],
                'cedula' => $this->orden['cedula'],
                'direccion' => $this->orden['direccion'],
                'provincia' => isset($this->orden['provincia']) ? $this->orden['provincia'] : null,
                'distrito' => isset($this->orden['distrito']) ? $this->orden['distrito'] : null,
                'corregimiento' => isset($this->orden['corregimiento']) ? $this->orden['corregimiento'] : null,
                'barrio' => isset($this->orden['barrio']) ? $this->orden['barrio'] : null,
                'telefono' => $this->orden['telefono'],
                'codigo_telefono' => isset($this->orden['codigo_telefono']) ? $this->orden['codigo_telefono'] : null,
            ]);
        }
        
        $this->orden['cliente_id'] = $cliente->id;
        $this->orden['impuesto'] = opcionSlug('impuesto') ? opcionSlug('impuesto') : 0;
        // Funcion anterior de envio
        // $this->orden['envio'] = $this->envio();
        // funcion para almacen local
        $this->orden['envio'] = opcionSlug('envio_local') ? opcionSlug('envio_local') : 0;
        $this->orden['tienda'] = currentTienda();
        $this->orden['estatus'] = $estatus;

        // Se desactiva la referencia
        if(isset($this->orden['transporte']))
        {
            $transporte = Transporte::find($this->orden['transporte']);
            $this->orden['transportista'] = $transporte ? $transporte->nombre : null;
            unset($this->orden['transporte']);
        }

        $orden = Orden::Create($this->orden);
        
        $otrosItems = [];

        // si sobrepasa el inventario toma el general
        foreach($this->items() as $key => $item)
        {
            if(Producto::find($item['producto_id']) && $item['cantidad'] > Producto::find($item['producto_id'])->disponible())
            {
                $otrosItems[$key] = $item;
                $otrosItems[$key]['cantidad'] = $item['cantidad'] - Producto::find($item['producto_id'])->disponible();
                
                \Cart::update( $item['producto_id'] , [
                    'quantity'=>[
                        'relative' => false,
                        'value' => Producto::find($item['producto_id'])->disponible()
                    ]
                ]);
            }
        }

        $orden->syncItems($this->items());
        // $orden->descontarInventario($this->items());

        // si hay items penditentes crea otra orden
        if(count($otrosItems))
        {
            $this->orden['envio'] = opcionSlug('envio_internacional') ? opcionSlug('envio_internacional') : 0;
            $this->orden['tienda'] = 2;
            $otraOrden = Orden::Create($this->orden);
            $otraOrden->syncItems($otrosItems);
            // se toma la tienda 2 provisionalmente
            // $otraOrden->descontarInventario($otrosItems , $this->orden['tienda']);
        }

        if($this->userId)
        {
            \Cart::session($this->userId);
        }

        \Cart::clear();

        try{
            Mail::to($orden->email)->send(new OrderMail($orden->id));
            if(opcionSlug('email_notificacion'))
            {
                Mail::to(opcionSlug('email_notificacion'))->send(new OrderMailAdmin($orden->id));
            }
            
        }catch(e){

        }

        return redirect()->route('confirm')->with('ordenado' , $orden->id);
    }

    public function tipoEnvio()
    {
        if(!isset($this->orden['retiro']))
        {
            return null;
        }

        $retiro = $this->orden['retiro'];

        switch ($retiro) {
            case 1:
                $out = 'Retiro en tienda';
                break;
            case 2:
                $out = 'Delivery';
                break;
            case 3:
                $out = 'Encomienda';
                break;
            
            default:
                $out = 'No Definido';
                break;
        }

        return $out;
    }

    public function validaciones()
    {
        $this->resetErrorBag();

        $this->validate([
            // 'terminos' => 'accepted',
            'orden.nombre' => 'required',
            'orden.apellido' => 'required',
            'orden.cedula' => 'required',
            'orden.direccion' => 'required',
            'orden.telefono' => 'required',
            'orden.provincia' => 'required',
            'orden.distrito' => 'required',
            'orden.retiro' => 'required',
            'orden.codigo_telefono' => 'required',
            'orden.email' => 'required',
            'orden.tipo_pago' => 'required',
        ]);

        if($this->orden['retiro'] == 2 || $this->orden['retiro'] == 3)
        {
            $this->validate([
                'orden.provincia_envio' => 'required',
                'orden.distrito_envio' => 'required',
                'orden.direccion_envio' => 'required',
                'orden.transporte' => 'required',
            ]);

            if( getProvincias(currentTiendaSlug())->where('nombre' , $this->orden['provincia_envio'])->count() == 0 )
            {   
                return $this->addError('orden.provincia', 'Esta dirección no está disponible para la tienda ' . currentTiendaName());
            }
        }

        if (!preg_match("/^[0-9-]+$/", $this->orden['cedula'])) {
            return $this->addError('orden.cedula', 'Sólo debe tener caracteres numéricos o guiones.');
        }

        $this->emit('mostrar-modal');
    }

    public function envio()
    {
        if(opcionSlug('envioGratis') && $this->subTotal() >= opcionSlug('envioGratis'))
        {
            return 0;
        }

        if(isset($this->orden['transporte']) && $this->orden['transporte'])
        {
            $transporte = Transporte::find($this->orden['transporte']);
            return $transporte ? $transporte->precio : 0;
        }

        // Desactivado temporalmente
        // if(isset($this->orden['retiro'])
        //     && ($this->orden['retiro'] == 2 || $this->orden['retiro'] == 3)
        //     && isset($this->orden['provincia_envio'])
        //     && $this->orden['provincia_envio']
        //     && isset($this->orden['distrito_envio'])
        //     && $this->orden['distrito_envio']
        // )
        // {
        //     $provincia = Ubicacion::where('nombre' , $this->orden['provincia_envio'])
        //                             ->where('tipo' , 1)
        //                             ->first();

        //     $distrito = Ubicacion::where('nombre' , $this->orden['distrito_envio'])
        //                             ->where('tipo' , 2)
        //                             ->first();

        //     $costoProvincia = $provincia ? $provincia->envio : 0;
        //     $costoDistrito = $distrito ? $distrito->envio : 0;

        //     return max($costoProvincia , $costoDistrito);
        // }

        return 0;
    }

    public function iniciarSesion()
    {
        $sesion = Auth::attempt(['email' => $this->email, 'password' => $this->password] , $this->remember);

        if($sesion)
        {
            return redirect()->route('checkout');
        }
    }

    public function items()
    {
        $items = [];

        if($this->userId)
        {
            \Cart::session($this->userId);
        }

        foreach(\Cart::getContent() as $key => $itemList)
        {
            $items[$key]['producto_id'] = $itemList->id;
            $items[$key]['nombre'] = $itemList->name;
            $items[$key]['precio'] = $itemList->price;
            $items[$key]['impuesto'] = $itemList->associatedModel->impuesto();
            $items[$key]['id_producto'] = $itemList->associatedModel->id_producto;
            $items[$key]['cantidad'] = $itemList->quantity;
        }

        return $items;
    }
}
