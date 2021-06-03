<x-dashboard-layout>

<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2><b>LES ENTREPRISES</b></h2></div>
                    <a href="{{route('entreprise.create')}}" class="btn btn-custom"></a>
                    
                    
                </div>
            </div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-center">Nom</th>
                       
                        <th class="text-center"> Nif</th>
                        <th class="text-center">Responsable</th>
                        <th class="text-center">Date de création</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 0; ?>
                @foreach($entreprises as $key => $value)
                <?php $n = $n + 1; ?>
                <?php $admin = App\Models\User::where('id', $value->utilisateur_id)->select('nom', 'prenom')->first() ?> 
                    <tr>
                        <td class="text-center"><?= $n ?></td>
                        <td class="text-center">{{ $value->nom }}</td>
                      
                        <td class="text-center">{{ $value->nif }}</td>
                        <td class="text-center">
                        @if ($admin != null)
                                {{ $admin->prenom." ".$admin->nom }}
                            @else
                                Non précisé 
                            @endif
                        </td>
                        <td class="text-center">{{ $value->date_creation}}</td>
                        <td class="justify-content-between icon-content text-center">
                            <a href="{{ route('entreprise.show', $value->slug) }}" class="col icon-action detail">
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