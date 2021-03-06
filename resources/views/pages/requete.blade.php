<div class="container dashboard-content">
    @if (Session::has('success'))
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <p>{{ Session::get('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="show-title">
                {!! $service->libelle !!}
            </div>
        </div>
    </div>
    @if($service->type=="demande")
        <div class="row">
            <div class="col-md-4 verification-subtitle">
                Code: 
            </div>
            <div class="col-md-8 show-detail">
            {{ $requete->code == NULL ? "Non assigné" : $requete->code }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 verification-subtitle">
                Etat:
            </div>
            <div class="col-md-8 show-detail">
                @if ( $requete->etat == 'Traitée')
                    <span class="badge badge-info padding">{{$requete->etat}}</span>
                @elseif ($requete->etat == 'Remis')
                    <span class="badge badge-success padding">{{$requete->etat}}</span>
                @else
                    <span class="badge badge-warning padding">{{$requete->etat}}</span>
                @endif 
            </div>
        </div>
    @endif
        <div class="row">
        @if($structure == NULL)
        <div class="col-md-4 verification-subtitle">
            Structure: 
        </div>   
        <div class="col-md-8 show-detail">
            Non pécisé
        </div>
        @else
        <div class="col-md-4 verification-subtitle">
            Structure: 
        </div> 
        <div class="col-md-8 show-detail">
            @if(Auth::user()->type == "admin-systeme" || Auth::user()->type == "admin-structure")
                <a href="{{ route('structure.show', $structure->slug) }}">{{ $structure->libelle}}</a>
            @else
                {{ $structure->libelle}}
            @endif
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-4 verification-subtitle">
            Prix: 
        </div>
        <div class="col-md-8 show-detail">
        {{ $service->prix }}
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="show-title">
                Résumé
            </div>
        </div>
    </div>
    
    <!--Données pour la rubrique eau et electricité -->
    @if($rubrique->slug == "eau-et-electricité")
        @include('layouts.data_eau_electricite')
    @endif

    <!--Données pour la rubrique impot et taxe -->
    @if($rubrique->slug == "impots-et-taxes")
        @include('layouts.data_impot')
    @endif

    <!--Données pour la rubrique automobile -->
    @if($rubrique->slug == "automobile")
        @include('layouts.data_automobile')
    @endif

    <!--Données pour le service carte d'identité -->
    @if($service->slug == "carte-national-didentite")
        @include('layouts.data_carte_didentite')
    @endif

    <!--Données pour le service passport -->
    @if($service->slug == "passport")
        @include('layouts.data_passport')
    @endif
        
    @if(Auth::user()->type == "admin-systeme" || Auth::user()->type == "admin-structure" || Auth::user()->type == "agent")
        @if($service->type=="demande")
            <div class="row col-md-4">
                <div class="mt-4 row justify-content-center">
                    <form  method="POST" action="{{ route('requete.update', $requete->id) }}">
                        @csrf
                        @method('PUT')
                        @if ($requete->etat == "En cours")
                            <button type="submit" class="mr-4 btn btn-outline-warning" onclick="return confirm('Confirmer la fin du traitement de la demande?')">
                                Traitement finis
                            </button>
                        @elseif ($requete->etat == "Traitée") 
                            <button type="submit" class="mr-4 btn btn-outline-info" onclick="return confirm('Confirmer la remise du document')">
                                Remettre à l'usager
                            </button>
                        @else
                        
                        @endif
                    </form>               
                </div>
            </div>
        @endif
    @endif
</div>
