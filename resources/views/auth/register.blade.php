<x-guest-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                
                <div class="auth-title">
                    <h1>INSCRIPTION</h1>
                </div>

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                <!--  Email Address -->
                    <div class="form-group">
                        <input id="email" class="input-custom" type="email" name="email" :value="old('email')" placeholder="Email" required autofocus />
                    </div>

                    <!-- Phone number -->
                    <div class="form-group mt-4">
                        <input  type="tel" id="telephone"
                        class="input-custom" 
                        placeholder="Téléphone" name="telephone" :value="old('telephone')" required />
                    </div>
                    <!-- Password -->
                    <div class="mt-4">
                        <input id="password" class="input-custom"
                                        type="password"
                                        name="password"
                                        placeholder="Mot de passe"
                                        required autocomplete="new-password"/>
                                        
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group mt-4">
                    
                        <input id="password_confirmation" class="input-custom"
                                        type="password"
                                        name="password_confirmation" 
                                        placeholder="Mot de passe confirmé"
                                        required />
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-custom">
                            {{ __('INSCRIPTION') }}
                        </button>
                    </div>
                    <div class="mt-5">
                        <p class="autre-lien">
                            Vous êtes déjà inscrit? 
                            <a class="btn-link" href="{{ route('login') }}">
                                {{ __('Connexion') }}
                        </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
