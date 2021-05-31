
<x-dashboard-layout>
    <div class="container dashboard-content">
            <div class="content-title">{{ __('CREATION D\'UN SERVICE') }}</div>
    
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
                <form method="POST" action="{{ route('service.store') }}">
                    @csrf
        
                    <!-- Libelle -->
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="libelle">Libelle</label>
                            <input id="libelle" class="input-custom" type="text" name="libelle" value="{{ old('libelle') }}" placeholder="LIBELLE" required />
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="duree">Durée</label>
                            <input id="duree" class="input-custom" type="text" name="duree" value="{{ old('duree') }}" placeholder="Durée"></input>
                        </div>
                    </div>

                   <!-- Structure et type -->
                    <div class="row mt-2">
                        <div class="col-md-6 form-group">
                                <label for="structure">Structure</label>
                                <select name="structure" id="strucutre" class="input-custom">
                                    <option value="">-- CHOISISSEZ ICI --</option>
                                    @foreach ($structures as $structure)
                                        <option value="{{ $structure->id }}">{{ $structure->libelle }}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="prix">Prix</label>
                            <input id="prix" class="input-custom" type="text" name="prix" value="{{ old('prix') }}" placeholder="Prix" />
                        </div>
                    
                    </div>

                     
                     <div class="row mt-2">
                        <div class="col-md-6 form-group">
                            <label for="description">Description</label>
                            <textarea id="description" class="input-custom" type="text" name="description" value="{{ old('description') }}" placeholder="Description,details"></textarea>
                        </div>
                        
                    </div>

                     
                    <div class="col-md-6 mt-4">
                        <button type="submit" class="btn btn-custom">
                            {{ __('AJOUTER') }}
                        </button>
                        <a href="{{ route('service.index') }}" type="button" class="btn btn-custom-secondary">
                            {{ __('ANNULER') }}
                        </a>
                    </div>
                </form>
    </div>
</x-dashboard-layout>
