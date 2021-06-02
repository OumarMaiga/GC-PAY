
<x-dashboard-layout>
    <div class="container dashboard-content">
            <div class="content-title">{{ __('CREATION D\'UNE ENTREPRISE') }}</div>
    
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
                <form method="POST" action="{{ route('entreprise.store') }}">
                    @csrf
        
                    <!-- Nom -->
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="nom">Nom</label>
                            <input id="nom" class="input-custom" type="text" name="nom" value="{{ old('nom') }}" placeholder="Nom" required />
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="nif">NIF</label>
                            <input id="nif" class="input-custom" type="text" name="nif" value="{{ old('nif') }}" placeholder="Numéro d'identification fiscale"></input>
                        </div>
                    </div>

                   <!-- creation et telephone -->
                    <div class="row mt-2">
                        <div class="col-md-6 form-group">
                            <label for="date_creation">Date de création</label>
                            <input id="date_creation" class="input-custom" type="text" name="date_creation" value="{{ old('date_creation') }}" placeholder="Mois Année" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="telephone">Telephone</label>
                            <input id="telephone" class="input-custom" type="text" name="telephone" value="{{ old('telephone') }}" placeholder="N° Telephone" />
                        </div>
                    </div>

                     
                     <div class="row mt-2">
                        <div class="col-md-6 form-group">
                            <label for="adresse">Adresse</label>
                            <textarea id="adresse" class="input-custom" type="text" name="adresse" value="{{ old('adresse') }}" placeholder="Ville, Commune, Quartier"></textarea>
                        </div>
                        
                        
                    </div>

                     
                    <div class="col-md-6 mt-4">
                        <button type="submit" class="btn btn-custom">
                            {{ __('AJOUTER') }}
                        </button>
                        <a href="{{ route('entreprise.index') }}" type="button" class="btn btn-custom-secondary">
                            {{ __('ANNULER') }}
                        </a>
                    </div>
                </form>
    </div>
</x-dashboard-layout>
