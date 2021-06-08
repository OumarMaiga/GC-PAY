<x-dashboard-layout>
    <div class="container dashboard-content">
        <div class="row">
            <div class="show-title">
                {{ $service->libelle }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 show-detail souligne">
                Code: 
            </div>
            <div class="col-md-8 show-detail closer">
                {{$requete->code}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 show-detail souligne">
                Etat:
            </div>
            <div class="col-md-8 show-detail closer">
                @if ( $requete->etat == 'Terminé')
                    <span class="badge badge-success padding">{{$requete->etat}}</span>
                @else
                    <span class="badge badge-info padding">{{$requete->etat}}</span>
                @endif 
            </div>
            </div>
            <div class="row">
            @if($structure==NULL)
            <div class="col-md-4 show-detail souligne">
                Structure: 
            </div>   
            <div class="col-md-8 show-detail">
                Non pécisé
            </div>
            @else
            <div class="col-md-4 show-detail souligne">
                Structure: 
            </div> 
            <div class="col-md-8 show-detail">
                <a href="{{ route('structure.show', $structure->slug) }}">{{ $structure->libelle}}</a>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-4 show-detail souligne">
                Prix: 
            </div>
            <div class="col-md-8 show-detail">
            {{ $service->prix }}
            </div>
        </div>
        <div class="row">
            @if($service==NULL)
            <div class="col-md-4 show-detail souligne">
                Service: 
            </div>   
            <div class="col-md-8 show-detail">
                Non pécisé
            </div>
            @else
            <div class="col-md-4 show-detail souligne">
                Service: 
            </div> 
            <div class="col-md-8 show-detail">
                <a href="{{ route('service.show', $service->slug) }}">{{ $service->libelle}}</a>
            </div>
            @endif
        </div>

        <div class="row">
            <div class="show-title">
                Résumé
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 show-detail souligne">
                Prix: 
            </div>
            <div class="col-md-8 show-detail">
                {{ $service->prix }}
            </div>
        </div>
       
        @if ($requete->code == NULL)
            <div class="row col-md-4">
                <div class="mt-4 row justify-content-center">
                    <form  method="POST" action="{{ route('requetes.update', $requete->id) }}">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="mr-4 btn btn-outline-warning" onclick="return confirm('Confirmer la fin du traitement de la demande?')">
                            TERMINER
                        </button>
                    </form>               
                </div>
            </div>
        @endif
    </div>
</x-dashboard-layout>
