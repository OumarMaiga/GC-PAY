<x-app-layout>

    <div class="show-title-second padding-block">
        {!! $service->libelle !!}
    </div>
    
    <div class="show-detail padding-block descript">
        {{$service->description}}
    </div>

    <div class="show-detail padding-block">
        <?php $structure = $service->structures()->first() ?>
        <span class="infos">Durée</span>:  {{$service->duree}} <span class="infos2">Prix:</span>  {{$service->prix}}  <span class="infos2">Structure:</span>  {{ ($structure != null) ? $structure->libelle : ""}}
    </div>
    
    <div class=" padding-block">
        <h1 class=" text-blue-800 size">Formulaire à remplir</h1>

        <!--Formulaire pour la rubrique eau et electricité -->
        @if($rubrique->slug=="eau-et-electricité")
        <form method="POST" action="{{ route('service.verification', $service->slug) }}">
            @csrf
            <div class="row padding-top">
            
            
                <div class="col-md-6 form-group">
                    
                    <input id="num-facture" class="input-custom" type="text" name="num-facture" value="{{ old('num-facture') }}" placeholder="Numéro de facture" required />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    
                    <input id="montant" class="input-custom" type="text" name="montant" value="{{ old('montant') }}" placeholder="Montant" required />
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
        @endif


        <!--Formulaire pour la rubrique impôts et taxes -->
        @if($rubrique->slug=="impots-et-taxes")
            <form method="POST" action="{{ route('service.verification', $service->slug) }}">
            @csrf
            
            <div class="row padding-top">
                <div class="col-md-6 form-group">
                                <select name="entreprise_id" id="entreprise_id" class="input-custom">
                                    <option value="">-- CHOISISSEZ ICI --</option>
                                    @foreach ($entreprises as $entreprise)
                                        <option value="{{ $entreprise->id }}">{{ $entreprise->libelle }}</option>
                                    @endforeach
                                    
                                </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    
                    <input id="montant_declarer" class="input-custom" type="text" name="montant_declarer" value="{{ old('montant_declarer') }}" placeholder="Montant déclaré" required />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    
                    <input id="montant_payer" class="input-custom" type="text" name="montant_payer" value="{{ old('montant_payer') }}" placeholder="Montant Payé" required />
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 form-group">
                    
                    <input id="periode" class="input-custom" type="text" name="periode" value="{{ old('periode') }}" placeholder="Période pour laquelle l'impôt ou la taxe est payé" required />
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
        @endif  


        <!--Formulaire pour la rubrique automobile -->
        @if($rubrique->slug=="automobile")
        <form method="POST" action="{{ route('service.verification', $service->slug) }}">
            @csrf
            <div class="row padding-top">
            
            
                <div class="col-md-6 form-group">
                    
                    <input id="numero_chassis" class="input-custom" type="text" name="numero_chassis" value="{{ old('numero_chassis') }}" placeholder="Numéro de chassis" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    
                    <input id="numero_immatriculation" class="input-custom" type="text" name="numero_immatriculation" value="{{ old('numero_immatriculation') }}" placeholder="Numéro immatriculation du véhicule" />
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
        @endif

        <!--Formulaire pour le service carte d'identité -->
        @if($service->slug=="carte-national-didentite")
        <form method="POST" action="#">
            @csrf
            <div class="row padding-top">
            
            
                <div class="col-md-6 form-group">
                    
                    <input id="nom" class="input-custom" type="text" name="nom" value="{{Auth::user()->nom}}" placeholder="Nom" />
                </div>
                <div class="col-md-6 form-group">
                    
                    <input id="prenom" class="input-custom" type="text" name="prenom" value="{{Auth::user()->prenom}}" placeholder="Prenom" />
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6 form-group">
                    
                    <input id="date_naissance" class="input-custom" type="text" name="date_naissance" value="{{ old('date_naissance') }}" placeholder="Date de Naissance" />
                </div>
                <div class="col-md-6 form-group">
                    
                    <input id="lieu_naissance" class="input-custom" type="text" name="lieu_naissance" value="{{ old('lieu_naissance') }}" placeholder="Lieu de naissance" />
                </div>
            </div>

             <div class="row">
                <div class="col-md-6 form-group">
                    
                    <input id="prenom_mere" class="input-custom" type="text" name="prenom_mere" value="{{ old('prenom_mere') }}" placeholder="Prenom de la mère" />
                </div>
                <div class="col-md-6 form-group">
                    
                    <input id="nom_mere" class="input-custom" type="text" name="nom_mere" value="{{ old('nom_mere') }}" placeholder="Nom de la mère" />
                </div>    
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    
                    <input id="prenom_pere" class="input-custom" type="text" name="prenom_pere" value="{{ old('prenom_pere') }}" placeholder="Prenom du père" />
                </div>
                <div class="col-md-6 form-group">
                    
                    <input id="adresse" class="input-custom" type="text" name="adresse" value="{{ old('adresse') }}" placeholder="Adresse" />
                </div>
            </div>
            <div class="row ">
              
                <div class="col-md-6 form-group">
                    
                    <input id="profession" class="input-custom" type="text" name="profession" value="{{ old('profession') }}" placeholder="Profession" />
                </div>
               
                <div class="col-md-6 form-group">
                    
                    <input id="taille" class="input-custom" type="text" name="taille" value="{{ old('taille') }}" placeholder="Taille de la personne" />
                </div>

            </div>
            <div class="row ">
                <div class="col-md-6 form-group">
                    
                    <input id="teint" class="input-custom" type="text" name="teint" value="{{ old('teint') }}" placeholder="Couleur de teint Noir, clair" />
                </div>
                <div class="col-md-6 form-group">
                    
                    <input id="cheveux" class="input-custom" type="text" name="cheveux" value="{{ old('cheveux') }}" placeholder=" Couleur de cheveux Noir, marron" />
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
        @endif

        <!--Formulaire pour le service passport -->
        @if($service->slug=="passport")
        <form method="POST" action="#">
            @csrf
            <div class="row padding-top">
            
            
                <div class="col-md-6 form-group">
                    
                    <input id="nom" class="input-custom" type="text" name="nom" value="{{Auth::user()->nom}}" placeholder="Nom" />
                </div>
                <div class="col-md-6 form-group">
                    
                    <input id="prenom" class="input-custom" type="text" name="prenom" value="{{Auth::user()->prenom}}" placeholder="Prenom" />
                </div>
            </div>
            <div class="row ">
                <div class="col-md-6 form-group">
                    
                    <input id="date_naissance" class="input-custom" type="text" name="date_naissance" value="{{ old('date_naissance') }}" placeholder="Date de Naissance" />
                </div>
                <div class="col-md-6 form-group">
                    
                    <input id="lieu_naissance" class="input-custom" type="text" name="lieu_naissance" value="{{ old('lieu_naissance') }}" placeholder="Lieu de naissance" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    
                    <input id="adresse" class="input-custom" type="text" name="adresse" value="{{ old('adresse') }}" placeholder="Adresse" />
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
        @endif

    </div>
</x-app-layout>