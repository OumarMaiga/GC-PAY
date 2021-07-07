 <form method="POST" action="{{ route('service.verification', $service->slug) }}" enctype="multipart/form-data">
    @csrf
    <div class="row padding-top">
        <div class="col-md-6 form-group">
            <label for="nom">Nom</label>
            <input id="nom" class="input-custom" type="text" name="nom" value="{{Auth::user()->nom}}" placeholder="Nom" required/>
        </div>
        <div class="col-md-6 form-group">
            <label for="prenom">Prenom</label>
            <input id="prenom" class="input-custom" type="text" name="prenom" value="{{Auth::user()->prenom}}" placeholder="Prenom" required/>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-6 form-group">
            <label for="date_naissance">Date de naissance</label>
            <input id="date_naissance" class="input-custom" type="date" name="date_naissance" value="{{ old('date_naissance') }}" placeholder="Date de Naissance" required/>
        </div>
        <div class="col-md-6 form-group">
            <label for="lieu_naissance">Lieu de naissance</label>
            <input id="lieu_naissance" class="input-custom" type="text" name="lieu_naissance" value="{{ old('lieu_naissance') }}" placeholder="Lieu de naissance" required/>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-6 form-group">
            <label for="numero_nina">Numero NINA</label>
            <input id="numero_nina" class="input-custom" type="text" name="numero_nina" value="{{ old('numero_nina') }}" placeholder="Numero NINA" required/>
        </div>
        <div class="col-md-6 form-group">
            <label for="adresse">Adresse</label>
            <textarea id="adresse" class="input-custom" type="text" name="adresse" value="" placeholder="Adresse">{{ old('adresse') }}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="identite">Justificatif d'identité</label>
            <input id="identite" class="input-custom" type="file" name="identite" value=""  required/>
        </div>
        <div class="col-md-6 form-group">
            <label for="photo-identite">Photo d'identité</label>
            <input id="photo-identite" class="input-custom" type="file" name="photo-identite" value="" />
        </div>

    </div>
    <div class="show-detail padding-top padding-bottom">
        Pour les enfants mineurs:
    </div>
    <div class="row">
    <div class="col-md-6 form-group">
            <label for="autorisation-parentale">Autorisation parentale si enfant mineur   </label>
            <input id="autorisation-parentale" class="input-custom" type="file" name="autorisation-parentale" value="" />
        </div>
        <div class="col-md-6 form-group">
            <label for="identite-tuteur">Justificatif d'identité du tuteur</label>
            <input id="identite-tuteur" class="input-custom" type="file" name="identite-tuteur" value="" />
        </div>
    </div>
    <div class="show-detail padding-top padding-bottom">
        Pour opérateurs économiques:
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="patente">Patente ou de la vignette synthétique si opérateurs économiques</label>
            <input id="patente" class="input-custom" type="file" name="patente" value=""/>
        </div>
        <div class="col-md-6 form-group">
            <label for="adresse">Structure</label>
            <select name="structure_id" id="structure_id" class="input-custom">
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