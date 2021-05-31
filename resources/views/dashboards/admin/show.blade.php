<x-dashboard-layout>
    <div class="container dashboard-content">
        <div class="row">
            <div class="col-md-4">
            @if (picture_exist($user->id))
                            <img src="/storage/profil_pictures/{{ picture_exist($user->id) }}" class="avatar"/>
                        @else
                            <img src='/storage/profil_pictures/default.jpg'class="profil-img"/>
                        @endif
               
                <div class="mt-4 row justify-content-center">
                    <a href="{{ route('admin.edit', $user->id) }}"> <button class="mr-4 btn btn-outline-warning">MODIFIER</button></a>

                    <form  method="POST" action="{{ route('admin.destroy', $user->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="ml-4 btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer l\'administrateur ?')">
                            RETIRER
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-md-8" >
                <div class="profil-name">
                    {{ $user->prenom." ".$user->nom }}
                </div>
                <div class="profil-type">
                    {{ $user->email }}
                </div>
                <div class="profil-description">
                    Téléphone: {{ $user->telephone }}
                </div>
                <div class="profil-description">
                    Adresse: {{ $user->adresse }}
                </div>
                <div class="profil-description">
                    Type: {{ $user->type }}
                </div>
                <div class="profil-description">
                    @if($structure==NULL)
                    Structure: <a href="{{ route('admin.edit', $user->id) }}" class="text-blue-700">Ajouter</a>
                    @else
                    Structure: <a href="{{ route('structure.show', $structure->slug) }}">{{ $structure->libelle}}</a>
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</x-dashboard-layout>
