<x-dashboard-layout>
    <div class="container dashboard-content">
        <div class="row">
            <div class="title-show">
                {{ $rubrique->libelle }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                Etat
            </div>
            <div class="col-md-8">
                @if ( $rubrique->etat == true)
                    <span class="badge badge-success">Acitve</span>
                @else
                    <span class="badge badge-danger">Desactive</span>
                @endif
            </div>
        </div>
        <div class="row">
            Ajouter par <i><a href="">{{ $user->prenom." ".$user->nom." (".$user->email.")" }}</a></i>
        </div>
        <div class="row col-md-4">
            <div class="mt-4 row justify-content-center">
                <a href="{{ route('rubrique.edit', $rubrique->slug) }}"> <button class="mr-4 btn btn-outline-warning">MODIFIER</button></a>

                <form  method="POST" action="{{ route('rubrique.destroy', $rubrique->id) }}">
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
