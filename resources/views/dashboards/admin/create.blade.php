
<x-dashboard-layout>
    <div class="container dashboard-content">
            <div class="content-title">{{ __('CREATION D\'UN ADMINISTRATEUR') }}</div>
    
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
                <form method="POST" action="{{ route('admin.store') }}">
                    @csrf
        
                    <!-- Nom et prenom -->
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="nom">Nom</label>
                            <input id="nom" class="input-custom" type="text" name="nom" value="{{ old('nom') }}" placeholder="NOM" required />
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="prenom">Prénom</label>
                            <input id="prenom" class="input-custom" type="text" name="prenom" value="{{ old('prenom') }}" placeholder="Prenom"></input>
                        </div>
                    </div>
                   <!-- Structure et type -->
                    <div class="row mt-2">
                    <div class="col-md-6 form-group">
                            <label for="email">Email</label>
                            <input id="email" class="input-custom" type="text" name="email" value="{{ old('email') }}" placeholder="Email"></input>
                        </div>
                        
                        
                    </div>

                     
                     <div class="row mt-2">
                        <div class="col-md-6 form-group">
                            <label for="adresse">Adresse</label>
                            <textarea id="adresse" class="input-custom" type="text" name="adresse" value="{{ old('adresse') }}" placeholder="Ville, Commune, Quartier"></textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="telephone">Telephone</label>
                            <input id="telephone" class="input-custom" type="text" name="telephone" value="{{ old('telephone') }}" placeholder="N° Telephone" />
                        </div>
                    </div>

                     
                    <div class="col-md-6 mt-4">
                        <button type="submit" class="btn btn-custom">
                            {{ __('AJOUTER') }}
                        </button>
                        <a href="{{ route('admin.index') }}" type="button" class="btn btn-custom-secondary">
                            {{ __('ANNULER') }}
                        </a>
                    </div>
                </form>
    </div>
</x-dashboard-layout>
