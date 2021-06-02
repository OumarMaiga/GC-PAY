
<x-dashboard-layout>
    <div class="container dashboard-content">
            <div class="content-title">{{ __('MODIFICATION D\'UNE ENTREPRISE') }}</div>
    
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
                <form method="POST" action="{{ route('entreprise.update',$entreprise->id) }}">
                    @csrf
                    @method('PUT')
        
                    <!-- Nom -->
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="nom">Nom</label>
                            <input id="nom" class="input-custom" type="text" name="nom" value="{{ $entreprise->nom }}" placeholder="Nom" required />
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="nif">NIF</label>
                            <input id="nif" class="input-custom" type="text" name="nif" value="{{ $entreprise->nif }}" placeholder="Numéro d'identification fiscale"></input>
                        </div>
                    </div>

                   <!-- Date de création et telephone -->
                    <div class="row mt-2">
                        <div class="col-md-6 form-group">
                            <label for="date_creation">Date de création</label>
                            <input id="date_creation" class="input-custom" type="text" name="date_creation" value="{{ $entreprise->date_creation }}" placeholder="Mois Année" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="telephone">Telephone</label>
                            <input id="telephone" class="input-custom" type="text" name="telephone" value="{{ $entreprise->telephone }}" placeholder="N° Telephone" />
                        </div>
                    </div>

                     
                     <div class="row mt-2">
                        <div class="col-md-6 form-group">
                            <label for="adresse">Adresse</label>
                            <textarea id="adresse" class="input-custom" type="text" name="adresse" placeholder="Ville, Commune, Quartier">{{ $entreprise->adresse}}</textarea>
                        </div>
                        
                        
                    </div>

                     
                    <div class="col-md-6 mt-4">
                        <button type="submit" class="btn btn-custom">
                            {{ __('MODIFIER') }}
                        </button>
                        <a href="{{ route('entreprise.index') }}" type="button" class="btn btn-custom-secondary">
                            {{ __('ANNULER') }}
                        </a>
                    </div>
                </form>
    </div>
</x-dashboard-layout>
