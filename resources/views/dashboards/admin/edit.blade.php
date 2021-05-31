
<x-dashboard-layout>
    <div class="container dashboard-content">
            <div class="content-title">{{ __('MODIFICATION D\'UN ADMINISTRATEUR') }}</div>
    
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

              
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
                <form method="POST" action="{{ route('admin.update',$user->id) }}">
                    @csrf
                    @method('PUT')
        
                    <!-- Nom et prenom -->
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="nom">Nom</label>
                            <input id="nom" class="input-custom" type="text" name="nom" value="{{ $user->nom }}" placeholder="NOM" required />
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="prenom">Prénom</label>
                            <input id="prenom" class="input-custom" type="text" name="prenom" value="{{ $user->prenom }}" placeholder="Prenom"></input>
                        </div>
                    </div>

                   <!-- Structure et type -->
                    <div class="row mt-2">
                        <div class="col-md-6 form-group">
                                <label for="structure">Structure</label>
                                <select name="structure" id="strucutre" class="input-custom">
                                    <option value="">-- CHOISISSEZ ICI --</option>
                                    @foreach ($structures as $structure)
                                        @if($structure->id==$user->structure_id)
                                        <option value="{{ $structure->id }}" selected="selected">{{ $structure->libelle }}</option>
                                        @else
                                        <option value="{{ $structure->id }}">{{ $structure->libelle }}</option>

                                        @endif
                                    @endforeach
                                </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="telephone">Telephone</label>
                            <input id="telephone" class="input-custom" type="text" name="telephone" value="{{ $user->telephone }}" placeholder="N° Telephone" />
                        </div>
                    </div>             
                     <div class="row mt-2">
                        <div class="col-md-6 form-group">
                            <label for="adresse">Adresse</label>
                            <textarea id="adresse" class="input-custom" type="text" name="adresse"  placeholder="Ville, Commune, Quartier"> {{ $user->adresse }}</textarea>
                        </div>
                        
                    </div>

                     
                    <div class="col-md-6 mt-4">
                        <button type="submit" class="btn btn-custom">
                            {{ __('MODIFIER') }}
                        </button>
                        <a href="{{ route('admin.index') }}" type="button" class="btn btn-custom-secondary">
                            {{ __('ANNULER') }}
                        </a>
                    </div>
                </form>
    </div>
</x-dashboard-layout>
