<div class="custom-form-contact">
    @if(session()->has('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="#" method="post" wire:submit.prevent="enviarContacto">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control" placeholder="Ingresa tu nombre completo" wire:model.defer="contacto.nombre" required>
                @error('contacto.nombre') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6">
                <input type="email" class="form-control" placeholder="Correo electrónico address" wire:model.defer="contacto.email" required>
                @error('contacto.email') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <input type="tel" class="form-control" placeholder="Teléfono" wire:model.defer="contacto.telefono" required>
                @error('contacto.telefono') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <textarea class="form-control" placeholder="Mensaje" wire:model.defer="contacto.mensaje" required></textarea>
                @error('contacto.mensaje') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
        </div>
        
        <div class="text-center mt-3" wire:ignore>
            <button 
                wire:loading.attr="disabled"
                type="submit"
                class="btn-enviar-custom g-recaptcha"
                data-sitekey="{{ env('RECAPTCHA_WEB', '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI') }}" 
                data-callback='onSubmit' 
                data-action='submit'>
                Enviar Mensaje &rarr;
            </button>
        </div>
    </form>
</div>
