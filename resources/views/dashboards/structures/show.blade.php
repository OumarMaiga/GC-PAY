<x-dashboard-layout>
    <div class="container dashboard-content">
        <div class="row">
            <div class="col-md-4">
                <img  src="" class="profil-img"/>
                <div class="mt-4 row justify-content-center">
                    <a href="{{ route('structure.edit', $structure->slug) }}"> <button class="mr-4 btn btn-outline-warning">MODIFIER</button></a>

                    <form  method="POST" action="{{ route('structure.destroy', $structure->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="ml-4 btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer la structure ?')">
                            RETIRER
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="profil-name">
                    {{ $structure->libelle }}
                </div>
                <div class="profil-type">
                    {{ $structure->type }}
                </div>
                <div class="profil-description">
                    Téléphone: {{ $structure->telephone }}
                </div>
                <div class="profil-description">
                    Adresse: {{ $structure->adresse }}
                </div>
                <div class="profil-description">
                    Administrateur: 
                    @if ($admin != null) 
                        <a href="{{ route('admin.show', $admin->email) }}">{{ $admin->prenom." ".$admin->nom }}</a>
                    @else
                        <!--<a href="{{ route('structure.edit', $structure->slug) }}" class="text-blue-700">Ajouter</a>-->
                    @endif
                </div>
                <br/>
                <hr/>
                <br/>
                <div class="row">
                    <div class="col text-center">
                        <h6 class="subtitle">Administrateur</h6>
                        <p class="number">{{ $nbre_admin }}</p>
                    </div>
                    <div class="col text-center">
                        <h6 class="subtitle">Agent</h6>
                        <p class="number">{{ $nbre_agent }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
