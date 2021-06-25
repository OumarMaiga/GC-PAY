<x-dashboard-layout>
    <div class="container dashboard-content">
        <div class="row">
            <div class="col-md-4">
                @if (photo_profil())
                    <img src="{{ (photo_profil()) }}" class="avatar"/>
                @else
                    <img src='/storage/profil_pictures/default.jpg'class="profil-img"/>
                @endif
               
                <div class="mt-4 row ">
                    
                    <form  method="POST" action="{{ route('usager.bloquer', $user->id) }}">
                        @csrf
                        @method('PUT')
                        @if($user->etat==true)
                        <button type="submit" class="mr-4 btn btn-outline-warning" onclick="return confirm('Voulez-vous bloquer l\'utilisateur ?')">
                            BLOQUER
                        </button>
                        @else
                        <button type="submit" class="mr-4 btn btn-outline-success" onclick="return confirm('Voulez-vous debloquer l\'utilisateur ?')">
                            DEBLOQUER
                        </button>
                        @endif

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
                    @if($user->type=="usager")
                        Type: Utilisateur simple de la plateforme
                    @elseif($user->type=="admin-structure")
                        Type: Adminstrateur Structure)
                    @else
                        Type: Administrateur Système
                    @endif
                </div>
                <div class="profil-description">
                    Inscrit Depuis: {{ custom_date($user->created_at) }}
                </div>
                
                
            </div>
        </div>
    </div>
</x-dashboard-layout>
