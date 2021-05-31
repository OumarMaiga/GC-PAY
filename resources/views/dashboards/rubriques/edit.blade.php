<x-dashboard-layout>
    <div class="container dashboard-content">
            <div class="content-title">{{ __('MODIFICATION DE STRUCUTRE') }}</div>
    
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
                <form method="POST" action="{{ route('rubrique.update', $rubrique->id) }}">
                    @csrf
                    @method('PUT')
        
                    <!-- Email Address -->
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="libelle">Nom de la rubrique</label>
                            <input id="libelle" class="input-custom" type="text" name="libelle" value="{{ old('libelle') }}" placeholder="RUBRIQUE" required />
                        </div>
                    </div>

                    <div class="col-md-6 mt-4">
                        <button type="submit" class="btn btn-custom">
                            {{ __('MODIFIER') }}
                        </button>
                        <a href="{{ route('rubrique.index') }}" type="button" class="btn btn-custom-secondary">
                            {{ __('ANNULER') }}
                        </a>
                    </div>
                </form>
    </div>
</x-dashboard-layout>
