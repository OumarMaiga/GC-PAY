<x-dashboard-layout>
    <div class="container dashboard-content">
   
            <div class="col-md-8" >
                <div class="profil-name">
                    {{ $entreprise->nom }}
                </div>
                <div class="profil-type">
                    NIF: {{ $entreprise->nif }}
                </div>
                <div class="profil-description">
                    Téléphone: {{ $entreprise->telephone }}
                </div>
                <div class="profil-description">
                    Adresse: {{ $entreprise->adresse }}
                </div>
                <div class="profil-description">
                    Date de création de l'entreprise: {{ $entreprise->date_creation}}
                </div>
                <div class="profil-description">
                    Ajouté par: {{$user->prenom.' '.$user->nom}}
                    
                </div>
                <div class="profil-description">     
                    Inscrit Depuis: {{ $entreprise->created_at}}
                </div>
                
            </div>
            <div class="mt-4 row left">
                    <a href="{{ route('entreprise.index') }}"> <button class="mr-4 btn btn-outline-warning">RETOUR</button></a>
            </div>
    
    </div>
</x-dashboard-layout>
