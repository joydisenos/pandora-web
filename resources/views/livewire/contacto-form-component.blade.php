<div>
    <form class="form-box" action="{{ route('enviar.contacto') }}" method="post" id="form-contacto" wire:submit.prevent="enviarContacto">
      @csrf
        @include('includes.mensajes')
        <ul class="list-unstyled">
            <li>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre:" wire:model="contacto.nombre">
            </li>
            <li>
                <input type="tel" name="telefono" id="telefono" placeholder="Teléfono:" wire:model="contacto.telefono">
            </li>
            <li>
                <input type="email" placeholder="Email:" name="email" id="email" wire:model="contacto.email">
            </li>
            <li>
                <input type="text" placeholder="Asunto:" name="asunto" id="email" wire:model="contacto.asunto">
            </li>
            <li>
                <textarea placeholder="Mensaje:" name="mensaje" id="mensaje" wire:model="contacto.mensaje"></textarea>
            </li>
        </ul>

        <div class="submit-btn" wire:ignore>
            <button 
            wire:loading.attr="disabled"
            type="submit"
            class="g-recaptcha"
            id="submit" 
            data-sitekey="{{ env('RECAPTCHA_WEB') }}" 
            data-callback='onSubmit' 
            data-action='submit'>
              Enviar
                  <figure class="mb-0">
                      <img src="assets/images/top-arrow.png" alt="top-arrow">
                  </figure>
            </button>
        </div>
    </form>
</div>
