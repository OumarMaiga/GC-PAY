<x-dashboard-layout>

<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2><b>LES UTILISATEURS</b></h2></div>

                    
                    
                </div>
            </div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-center">Nom Prenom</th>
                       
                        <th class="text-center"> email</th>
                        <th class="text-center">telephone</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 0; ?>
                @foreach($users as $key => $value)
                <?php $n = $n + 1; ?>
                    <tr>
                        <td class="text-center"><?= $n ?></td>
                        <td class="text-center">{{ $value->nom }}   {{ $value->prenom }}</td>
                      
                        <td class="text-center">{{ $value->email }}</td>
                        <td class="text-center">{{ $value->telephone }}</td>
                        <td class="justify-content-between icon-content text-center">
                            <a href="{{ route('usager.show', $value->email) }}" class="col icon-action detail">
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