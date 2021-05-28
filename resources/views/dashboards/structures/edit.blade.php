<x-dashboard-layout>
    <div class="container dashboard-content">
            <div class="content-title">{{ __('MODIFICATION DE STRUCUTRE') }}</div>
    
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
                <form method="POST" action="{{ route('structure.update', $structure->id) }}">
                    @csrf
                    @method('PUT')
        
                    <!-- Email Address -->
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="libelle">Nom de la structure</label>
                            <input id="libelle" class="input-custom" type="text" name="libelle" value="{{ $structure->libelle }}" placeholder="STRUCUTRE" required />
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="type">Type de structure</label>
                            <select name="type" id="type" class="input-custom">
                                <option value="">-- CHOISISSEZ ICI --</option>
                                <option value="maire">MAIRIE</option>
                                <option value="hopital">HOPITAL</option>
                                <option value="impot">IMPÔT</option>
                                <option value="autre">AUTRE</option>
                            </select>
                        </div>
                    </div>
                    <!-- Email Address -->
                    <div class="row mt-2">
                        <div class="col-md-6 form-group">
                            <label for="adresse">Adresse</label>
                            <textarea id="adresse" class="input-custom" type="text" name="adresse" value="" placeholder="Ville, Commune, Quartier">{{ $structure->adresse }}</textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="telephone">Telephone</label>
                            <input id="telephone" class="input-custom" type="text" name="telephone" value="{{ $structure->telephone }}" placeholder="N° Telephone" />
                        </div>
                    </div>
        
                    <div class="col-md-6 mt-4">
                        <button type="submit" class="btn btn-custom">
                            {{ __('MODIFIER') }}
                        </button>
                        <a href="{{ route('structure.index') }}" type="button" class="btn btn-custom-secondary">
                            {{ __('ANNULER') }}
                        </a>
                    </div>
                </form>
    </div>
</x-dashboard-layout>
