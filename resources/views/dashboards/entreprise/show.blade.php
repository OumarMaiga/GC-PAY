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
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 0; ?>
                <?php $n = $n + 1; ?>
               
                    <tr>
                        <td class="text-center"><?= $n ?></td>
                        <td class="text-center"></td>
                      
                        <td class="text-center"></td>
                        <td class="text-center">
                     
                        <td class="justify-content-between icon-content text-center">
                            <a href="#" class="col icon-action detail">
                                <span class="fas fa-info">
                                </span>
                            </a>
                            <a href="#" class="col icon-action icon-edit">
                                <span class="fas fa-user-edit edit">
                                </span>
                            </a>
                            <span class="col icon-action">
                                <form  method="POST" action="#" class="d-inline-flex">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" onclick="return confirm('Voulez-vous supprimer l\'administrateur ?')">
                                        <span class="fas fa-user-times supp"></span>
                                    </button>
                                </form>
                            </span>
                            
                        </td>
                    </tr>
                 
                </tbody>
            </table>
           
  
</div>   
</x-app-layout>

