<x-dashboard-layout>
    <div class="container dashboard-content">
        <div class="row">
            <div class="show-title">
                {{ $requete->slug }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 show-subtitle">
                Etat: {{$requete->etat}}
            </div>
            </div>
        <div class="row">
            <div class="col-md-4 show-subtitle">
                Paiement
            </div>
            <div class="col-md-8 show-detail">
                @if ( $requete->paye == true)
                    <span class="badge badge-success">Effecté</span>
                @else
                    <span class="badge badge-danger">Non effecté</span>
                @endif
            </div>
            </div>
        <div class="row">
            @if($service==NULL)
                Service: Non pécisé
            @else
                Service: <a href="{{ route('service.show', $service->slug) }}">{{ $service->libelle}}</a>
            @endif
        </div>
        <div class="row">
            @if($structure==NULL)
                Structure: Non pécisée
            @else
                Structure: <a href="{{ route('structure.show', $structure->slug) }}">{{ $structure->libelle}}</a>
            @endif
        </div>
        <div class="row show-detail">
            Effectué par: <i><a href="{{ route('admin.show', $user->email) }}"> {{ $user->prenom." ".$user->nom." (".$user->email.")" }}</a></i>
        </div>
        <div class="row col-md-4">
            <div class="mt-4 row justify-content-center">
                <a href="{#"> <button class="mr-4 btn btn-outline-warning">TRAITER</button></a>

                <form  method="POST" action="{{ route('requetes.destroy', $requete->id) }}">
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
