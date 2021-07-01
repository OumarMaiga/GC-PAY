<x-app-layout>
    <div class="container-fluid">
        <div class="list-group mt-2">
            @foreach ($historiques as $historique)
                <div class="day">
                    {{ custom_day($historique->created_at) }}
                </div> 
                <a href="{{ route('detail.requete', $historique->requete()->associate($historique->requete_id)->requete->slug) }}" class="list-link">
                    <div class="list-group-item list-group-item-action list-group-item-unseen">
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="service">
                                    {!! $historique->service()->associate($historique->service_id)->service->libelle." à ".$historique->structure()->associate($historique->structure_id)->structure->libelle !!}
                                </div>
                                <div class="heure">
                                    {!! $historique->created_at->format('H:i') !!}
                                </div>                                
                            </div>
                            <div class="col-sm-2 d-flex justify-content-end prix">
                                {!! $historique->montant !!} F
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>