<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactoMail;

class ContactoFormComponent extends Component
{
    public $contacto;

    protected $listeners = ['enviarContacto'];

    public function render()
    {
        return view('livewire.contacto-form-component');
    }

    public function enviarContacto($token = null)
    {
        if(!$token)
        {
            return session()->flash('status' , 'Verificar Token');
        }
        
        $this->validate([
            'contacto.nombre' => 'required',
            'contacto.email' => 'required|email:rfc,dns',
            'contacto.telefono' => 'required',
            'contacto.asunto' => 'required',
            'contacto.mensaje' => 'required',
        ]);

        Mail::to(opcionSlug('email_contacto'))->send(new ContactoMail($this->contacto));

        session()->flash('status' , 'Mensaje Enviado');
    }
}
