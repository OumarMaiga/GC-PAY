<x-guest-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                
                <div class="auth-title">
                    CHANGER DE MOT DE PASSE
                </div>

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="form-group">
                        <input id="email" class="input-custom" type="email" name="email" value="{{ old('email', $request->email) }}" placeholder="EMAIL" required autofocus />
                    </div>

                    <!-- Password -->
                    <div class="mt-4 form-group">
                        <input id="password" class="input-custom" type="password" name="password" placeholder="MOT DE PASSE" required />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4 form-group">

                        <input id="password_confirmation" class="input-custom"
                                            type="password"
                                            name="password_confirmation" placeholder="CONFIRMATION DE MOT DE PASSE" required />
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
</x-guest-layout>
