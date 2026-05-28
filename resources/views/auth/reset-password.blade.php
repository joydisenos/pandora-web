<x-guest-layout>
    <div style="display: flex; min-height: 100vh; font-family: 'Nunito', sans-serif;">
        <!-- Left Side: Image -->
        <div style="flex: 1; background-image: url('{{ asset('img/banner-3.jpg') }}'); background-size: cover; background-position: center; display: none;" class="desktop-bg">
        </div>
        
        <!-- Right Side: Form -->
        <div style="flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #f9fafb; padding: 2rem;">
            <div style="width: 100%; max-width: 400px;">
                <div style="text-align: center; margin-bottom: 2rem;">
                    <img src="{{ asset('assets/img/logo_pandora.png') }}" style="max-width: 220px; margin: 0 auto;" alt="Pandora Hotel Collection">
                </div>

                <div style="background-color: #fff; border: 1px solid #e5e7eb; padding: 2rem; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);">
                    <x-jet-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div style="margin-bottom: 1rem;">
                            <label for="email" style="display: block; font-size: 0.75rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">{{ __('Email') }}</label>
                            <input id="email" style="display: block; width: 100%; border: 1px solid #d1d5db; background-color: transparent; font-size: 0.875rem; padding: 0.5rem 0.75rem; outline: none; box-sizing: border-box;" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                        </div>

                        <div style="margin-bottom: 1rem;">
                            <label for="password" style="display: block; font-size: 0.75rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">{{ __('Nueva Contraseña') }}</label>
                            <input id="password" style="display: block; width: 100%; border: 1px solid #d1d5db; background-color: transparent; font-size: 0.875rem; padding: 0.5rem 0.75rem; outline: none; box-sizing: border-box;" type="password" name="password" required autocomplete="new-password" />
                        </div>

                        <div style="margin-bottom: 1.5rem;">
                            <label for="password_confirmation" style="display: block; font-size: 0.75rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">{{ __('Confirmar Contraseña') }}</label>
                            <input id="password_confirmation" style="display: block; width: 100%; border: 1px solid #d1d5db; background-color: transparent; font-size: 0.875rem; padding: 0.5rem 0.75rem; outline: none; box-sizing: border-box;" type="password" name="password_confirmation" required autocomplete="new-password" />
                        </div>

                        <div>
                            <button type="submit" style="width: 100%; background-color: #D48A1F; color: #fff; font-weight: 600; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.875rem; border: none; cursor: pointer;">
                                Restablecer Contraseña
                            </button>
                        </div>
                    </form>
                </div>
                
                <div style="text-align: center; margin-top: 2rem; font-size: 0.75rem; font-weight: 500;">
                    <a href="{{ route('politicas.privacidad') }}" style="color: #1d4ed8; text-decoration: none;">Privacy Policy</a>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        @media (min-width: 1024px) {
            .desktop-bg {
                display: block !important;
            }
        }
    </style>
</x-guest-layout>
