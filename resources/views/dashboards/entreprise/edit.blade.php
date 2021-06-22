
<x-app-layout>
<form method="POST" action="{{ route('entreprise.update',$entreprise->id) }}">
                    @csrf
                    @method('PUT')
        
    <div class="profil-name padding-block row">
        {{ $entreprise->nom }}
                   
       
    </div>
    <div class="profil-type padding-block">
        NIF: {{ $entreprise->nif }}
    </div>
    <div class="show-detail padding-block row">
        <div class="col-md-2"> Responsable: </div>
        <div class="col-md-2"> 
            <input id="responsable" class="input-custom" type="text" name="responsable" value="{{ $entreprise->responsable }}" placeholder="Responsable" />
        </div>
        
    </div>
    <div class="show-detail padding-block row">
        <div class="col-md-2"> Téléphone: </div>
        <div class="col-md-2">
            <input id="telephone" class="input-custom" type="text" name="telephone" value="{{ $entreprise->telephone }}" placeholder="N° Telephone" />
        </div>
    </div>
    <div class="show-detail padding-block row">
        <div class="col-md-2"> Adresse: </div>
        <div class="col-md-2">
            <textarea id="adresse" class="input-custom" type="text" name="adresse" placeholder="Ville, Commune, Quartier">{{ $entreprise->adresse}}</textarea>
        </div>
        
    </div>
    <div class="show-detail padding-block row">
            <div class="col-md-2"> Date de création: </div>
            <div class="col-md-2">
                <input id="date_creation" class="input-custom" type="text" name="date_creation" value="{{ $entreprise->date_creation }}" placeholder="Mois Année" />
            </div>
            
            
        </div>
        <div class="col-md-6 mt-4 padding-block">
                        <button type="submit" class="btn btn-outline-warning">
                            {{ __('MODIFIER') }}
                        </button>
                       
                    </div>
    </form>

    <div class="show-subtile  padding-block">
        <b> TRANSACTIONS</b>
    </div>
    <div class="container2 padding-block">
     
                <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-center">Service</th>
                        <th class="text-center"> Montant</th>
                        <th class="text-center">Réalisé par</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 0; ?>
                    @foreach($impots as $key => $value)
                    <?php $n = $n + 1; ?>
                    <?php  $requete=App\Models\Requete::where('id',$value->requete_id)->first();   
                     $usager=App\Models\User::where('id',$requete->usager_id)->first();       ?>
                    
                    <tr>
                        <td class="text-center"><?= $n ?></td>
                        <td class="text-center">{{$value->libelle}}</td>
                      
                        <td class="text-center">{{$value->montant_payer}}</td>
                        <td class="text-center">
                        {{$usager->prenom.' '.$usager->nom}}
                     
                    </tr>
                 @endforeach
                </tbody>
            </table>
           
  
</div>   
</x-app-layout>

