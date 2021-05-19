<x-guest-layout>
    <x-auth-card>
   
    <x-slot name="title">
            <h1>INSCRIPTION</h1>
        </x-slot>
        

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

           <!--  Email Address -->
           <div>
                

               
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="Email" required autofocus />
            </div>

            <!-- Phone number -->
            <div class="mt-4">
                

            <x-input  type="tel" id="telephone"
                class="block mt-1 w-full" 
                placeholder="Téléphone" name="telephone" :value="old('telephone')" required />
            </div>

            
            <!-- Password -->
            <div class="mt-4">
                

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                placeholder="Mot de passe"
                                required autocomplete="new-password"/>
                                 
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
               
                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" 
                                placeholder="Mot de passe confirmé"
                                required />
            </div>

            <div class="flex items-center justify-end mt-4">
               

                <x-button class=" block mt-1 w-full">
                    {{ __('Inscription') }}
                </x-button>
            </div>
            </br> </br>
            <p class="block mt-1 w-full text-center"> Vous êtes déjà inscrit? <a class="underline text-sm  hover:text-gray-900 ecritblue" href="{{ route('login') }}">
                    {{ __('Connexion?') }}
                </a>
            </p>
        </form>
    </x-auth-card>
</x-guest-layout>
