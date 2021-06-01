<x-dashboard-layout>
    <div class="container dashboard-content">
        <div class="row">
            <div class="show-title">
                {{ $service->libelle }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 show-subtitle">
                Etat
            </div>
            <div class="col-md-8 show-detail">
                @if ( $service->etat == true)
                    <span class="badge badge-success">Acitve</span>
                @else
                    <span class="badge badge-danger">Desactive</span>
                @endif
            </div>
            </div>
        <div class="row">
            <div class="col-md-4 show-subtitle">
                Description: {{$service->description}}
            </div>
            </div>
        <div class="row">
            <div class="col-md-4 show-subtitle">
                Prix: {{$service->prix}}
            </div>
            </div>
        <div class="row">
            <div class="col-md-4 show-subtitle">
                Durée: {{$service->duree}}
            </div>

        </div>
        <div class="row">
            @if($rubrique==NULL)
                Rubrique: <a href="{{ route('service.edit', $service->slug) }}" class="text-blue-700">Ajouter</a>
            @else
                Rubrique: <a href="{{ route('rubrique.show', $rubrique->slug) }}">{{ $rubrique->libelle}}</a>
            @endif
        </div>
        <div class="row">
            @if($structure==NULL)
                Structure: <a href="{{ route('service.edit', $service->slug) }}" class="text-blue-700">Ajouter</a>
            @else
                Structure: <a href="{{ route('structure.show', $structure->slug) }}">{{ $structure->libelle}}</a>
            @endif
        </div>
        <div class="row show-detail">
            Ajouté par: <i><a href=""> {{ $user->prenom." ".$user->nom." (".$user->email.")" }}</a></i>
        </div>
        <div class="row col-md-4">
            <div class="mt-4 row justify-content-center">
                <a href="{{ route('service.edit', $service->slug) }}"> <button class="mr-4 btn btn-outline-warning">MODIFIER</button></a>

                <form  method="POST" action="{{ route('service.destroy', $service->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="ml-4 btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer la structure ?')">
                        RETIRER
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>
