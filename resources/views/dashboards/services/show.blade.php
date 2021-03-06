<x-dashboard-layout>
    <div class="container dashboard-content">
        <div class="show-title-second">
            {!! $service->libelle !!}
        </div>
        
        <div class="show-detail descript">
            {!! $service->description !!}
        </div>
    
        <div class="show-detail mt-3">
            <?php $structure = $service->structures()->first() ?>
            <span class="infos">Durée</span>:  {{ $service->duree }} 
            <span class="infos2">Prix:</span>  {{ $service->prix }}  
            <span class="infos2">Structure:</span>
                @if($structures->count() == 0)
                    Non précisée
                @elseif($structures->count() == 1)
                    @foreach ($structures as $structure)
                        {{ $structure->libelle }}
                    @endforeach
                @else
                    <div class="dropdown d-inline">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cliquez pour voir
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach ($structures as $structure)
                                <a class="dropdown-item" href="#">{{ $structure->libelle }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
        </div>
    
        @if (Auth::user()->type == "admin-systeme")
            <div class="show-detail mt-2">
                <span class="infos">Ajouté par:</span> <i><a href="{{ route('admin.show', $user->email) }}"> {{ $user->prenom." ".$user->nom." (".$user->email.")" }}</a></i>
            </div>
            <div class="mt-2">
                <a href="{{ route('service.edit', $service->slug) }}"> <button class="mr-4 btn btn-outline-warning">MODIFIER</button></a>

                <form  method="POST" action="{{ route('service.destroy', $service->id) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="ml-4 btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer la structure ?')">
                        RETIRER
                    </button>
                </form>
            </div>
        @endif
    </div>
</x-dashboard-layout>
