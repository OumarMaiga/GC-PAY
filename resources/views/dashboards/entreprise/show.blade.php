<x-app-layout>
          
    <div class="profil-name padding-block row">
        {{ $entreprise->nom }}
                   
        <div class="col-md-6 padding-right">
            <a href="{{ route('entreprise.edit',$entreprise->slug) }}"> <button class="mr-4 btn btn-outline-warning">MODIFIER</button></a>
        </div>
    </div>
    <div class="profil-type padding-block">
        NIF: {{ $entreprise->nif }}
    </div>
    <div class="show-detail padding-block row">
        <div class="col-md-2"> Responsable: </div>
        {{ $entreprise->responsable }}
    </div>
    <div class="show-detail padding-block row">
        <div class="col-md-2"> Téléphone: </div>
        {{ $entreprise->telephone }}
    </div>
    <div class="show-detail padding-block row">
        <div class="col-md-2"> Adresse: </div>
        {{ $entreprise->adresse }}
    </div>
    <div class="show-detail padding-block row">
        <div class="col-md-2"> Date de création: </div>
        {{  $entreprise->date_creation }}
    </div>

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

