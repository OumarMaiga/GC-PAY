<x-guest-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                
                <div class="auth-title">
                    CONNEXION
                </div>

                <!-- Session Status -->
                <x-auth-session-error class="mb-4" :error="session('error')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group">
                        <!--<x-label for="email" :value="__('Email')" />-->

                        <input id="login" class="input-custom" type="text" name="login" value="{{ old('telephone') ?: old('email') }}" placeholder="EMAIL / TELEPHONE" required />
                    </div>

                    <!-- Password -->
                    <div class="form-group mt-4">
                        <!--<x-label for="password" :value="__('Password')" />-->

                        <input id="password" class="input-custom"
                                        type="password"
                                        name="password"
                                        placeholder="MOT DE PASSE"
                                        required autocomplete="current-password" />
                    </div>
                        @if (Route::has('password.request'))
                            <a class="password-forgotten" href="{{ route('password.request') }}">
                                {{ __('Mot de passe oubliée?') }}
                            </a>
                        @endif
                    <!-- Remember Me -->
                    <div class="form-group block mt-5">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Se souvenir de moi') }}</span>
                        </label>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-custom">
                            {{ __('CONNEXION') }}
                        </button>
                    </div>
                    <div class="mt-5">
                        <p class="autre-lien">
                            Vous n'êtes pas inscrit ? <a class="btn-link" href="{{ route('register') }}">Inscription</a> 
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
