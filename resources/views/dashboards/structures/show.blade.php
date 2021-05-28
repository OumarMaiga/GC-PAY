<x-dashboard-layout>
    <div class="container dashboard-content">
        <div class="row">
            <div class="col-md-4">
                <img alt="profil" src="" class="profil-img"/>
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
                    Administrateur: <a href="#">{{ $admin->prenom." ".$admin->nom }}</a>
                </div>
                <br/>
                <hr/>
                <br/>
                <div class="row">
                    <div class="col text-center">
                        <h6 class="subtitle">Administrateur</h6>
                        <p class="number">1</p>
                    </div>
                    <div class="col text-center">
                        <h6 class="subtitle">Agents</h6>
                        <p class="number">0</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
