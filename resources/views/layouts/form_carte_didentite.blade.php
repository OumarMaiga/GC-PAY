<form method="POST" action="{{ route('service.verification', $service->slug) }}">
    @csrf
    <div class="row padding-top">
        <div class="col-md-6 form-group">
            <label for="nom">Nom</label>
            <input id="nom" class="input-custom" type="text" name="nom" value="{{Auth::user()->nom}}" placeholder="Nom" />
        </div>
        <div class="col-md-6 form-group">
            <label for="prenom">Prenom</label>
            <input id="prenom" class="input-custom" type="text" name="prenom" value="{{Auth::user()->prenom}}" placeholder="Prenom" />
        </div>
    </div>
    <div class="row ">
        <div class="col-md-6 form-group">
            <label for="date_naissance">Date de naissance</label>
            <input id="date_naissance" class="input-custom" type="date" name="date_naissance" value="{{ old('date_naissance') }}" placeholder="Date de Naissance" />
        </div>
        <div class="col-md-6 form-group">
            <label for="lieu_naissance">Lieu de naissance</label>
            <input id="lieu_naissance" class="input-custom" type="text" name="lieu_naissance" value="{{ old('lieu_naissance') }}" placeholder="Lieu de naissance" />
        </div>
    </div>

        <div class="row">
        <div class="col-md-6 form-group">
            <label for="prenom_pere">Prenom du père</label>
            <input id="prenom_pere" class="input-custom" type="text" name="prenom_pere" value="{{ old('prenom_pere') }}" placeholder="Prenom du père" />
        </div>
        <div class="col-md-6 form-group">
            <label for="prenom_nom_mere">Prenom et nom de la mère</label>
            <input id="prenom_nom_mere" class="input-custom" type="text" name="prenom_nom_mere" value="{{ old('prenom_nom_mere') }}" placeholder="Prenom et nom de la mère" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 form-group">
            <label for="adresse">Adresse</label>
            <textarea id="adresse" class="input-custom" type="text" name="adresse" value="" placeholder="Adresse">{{ old('adresse') }}</textarea>
        </div>
        <div class="col-md-6 form-group">
            <label for="profession">Profession</label>
            <input id="profession" class="input-custom" type="text" name="profession" value="{{ old('profession') }}" placeholder="Profession" />
        </div>
    </div>
    <div class="row ">
        <div class="col-md-4 form-group">
            <label for="taille">Taille de la personne</label>
            <input id="taille" class="input-custom" type="text" name="taille" value="{{ old('taille') }}" placeholder="Taille de la personne" />
        </div>
        <div class="col-md-4 form-group">
            <label for="teint">Teint</label>
            <input id="teint" class="input-custom" type="text" name="teint" value="{{ old('teint') }}" placeholder="Couleur de teint Noir, clair" />
        </div>
        <div class="col-md-4 form-group">
            <label for="Cheveux">Cheveux</label>
            <input id="cheveux" class="input-custom" type="text" name="cheveux" value="{{ old('cheveux') }}" placeholder=" Couleur de cheveux Noir, marron" />
        </div>
    </div>     
    <div class="row ">
        <div class="col-md-6 form-group">
            <label for="structure_id">Structure</label>
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