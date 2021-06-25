<x-dashboard-layout>

<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2><b>LES REQUÊTES ARCHIVES</b></h2></div>
                    
                </div>
            </div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-center"> Service</th>
                        <th class="text-center">Usager</th>
                        <th class="text-center">Etat</th>
                        <th class="text-center">Code</th>
                        <th class="text-center">Paiement</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php $n = 0 ?>
                @foreach($requetes as $value)
                <?php
                    $n = $n + 1;
                    $structure=App\Models\Structure::where('id',$value->structure_id)->first(); 
                    $service=App\Models\Service::where('id',$value->service_id)->first();    
                    $usager=App\Models\User::where('id',$value->usager_id)->first();     
                ?>
                        <tr>
                        <td class="text-center">{{ $n }}</td>
                        @if($service == NULL)
                            <td class="text-center">Non précisée</td>
                        @else
                            <td class="text-center">{{ $service->libelle }}</td>
                        @endif

                        @if($usager == NULL)
                            <td class="text-center">Non précisée</td>
                        @else
                            <td class="text-center">{{ $usager->prenom.' '.$usager->nom }}</td>
                        @endif
                        
                        <td class="text-center">{{ $value->etat }}</td>
                        <td class="text-center">{{ $value->code }}</td>
                        @if($value->paye==true)
                            <td class="text-center">Effectué</td>
                        @else
                            <td class="text-center">Non effectué</td>
                        @endif
                        <td class="justify-content-between icon-content text-center">
                            <a href="{{ route('requetes.show', $value->slug) }}" class="col icon-action detail">
                                <span class="fas fa-info">
                                </span>
                            </a>                         
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
           
        </div>
    </div>  
</div>   

</x-dashboard-layout>