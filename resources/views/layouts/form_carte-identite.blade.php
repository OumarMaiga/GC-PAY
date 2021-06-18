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