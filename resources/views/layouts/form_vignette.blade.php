<form method="POST" action="{{ route('service.verification', $service->slug) }}">
            @csrf
            <div class="row padding-top">
                <div class="col-md-6 form-group">
                    <label for="numero_chassis">Numero de chassis</label>
                    <input id="numero_chassis" class="input-custom" type="text" name="numero_chassis" value="{{ old('numero_chassis') }}" placeholder="Numéro de chassis" required/>
                </div>
                <!--
                <div class="col-md-6 form-group">
                    <label for="numero_immatriculation">Numero d'immatriculation du véhicule</label>
                    <input id="numero_immatriculation" class="input-custom" type="text" name="numero_immatriculation" value="{{ old('numero_immatriculation') }}" placeholder="Numéro immatriculation" />
                </div>
                -->
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="adresse">Structure</label>
                    <select name="structure_id" id="structure_id" class="input-custom">
                        <option value="">-- CHOISISSEZ ICI --</option>
                        @foreach ($structures as $structure)
                            <option value="{{ $structure->id }}">{{ $structure->libelle }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6 mt-4">
                <button type="submit" class="btn btn-custom">
                    {{ __('SOUMETTRE') }}
                </button>
                <a href="{{ route('accueil') }}" type="button" class="btn btn-custom-secondary">
                    {{ __('ANNULER') }}
                </a>
            </div>
</form>