<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
                <div class="col-12 auth-title">
                    CHANGER DE MOT DE PASSE
                </div>
            <div class="col-md-4">
                
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                
                <!-- Session Error -->
                <x-auth-session-error class="mb-4" :error="session('error')" />

                <form method="POST" action="{{ route('update_password') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group">
                        <input id="current_password" class="input-custom" type="password" name="current-password" placeholder="MOT DE PASSE ACTUEL" required autofocus />
                    </div>

                    <!-- Password -->
                    <div class="mt-4 form-group">
                        <input id="password" class="input-custom" type="password" name="new-password" placeholder="NOUVEAU MOT DE PASSE" required />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4 form-group">

                        <input id="new-password-confirmation" class="input-custom"
                                            type="password"
                                            name="new-password_confirmation" placeholder="CONFIRMATION DU NOUVEAU MOT DE PASSE" required />
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn-custom">
                            {{ __('CHANGER') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
