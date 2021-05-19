<x-guest-layout>
    <x-auth-card>
   
        <div class=" min-h-screen">
          
        
        <div class="auth-title">
        MOT DE PASSE OUBLIE
                </div>

        

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
             
                        <input id="email" class="input-custom" type="text" name="email" value="{{ old('telephone') ?: old('email') }}" placeholder="EMAIL / TELEPHONE" required />
                    </div>

           
                    <div class="mt-4">
                        <button type="submit" class="btn-custom">
                            {{ __('ENVOYER') }}
                        </button>
                    </div>
         </div>
        
        
        </form>
    </x-auth-card>
</x-guest-layout>
