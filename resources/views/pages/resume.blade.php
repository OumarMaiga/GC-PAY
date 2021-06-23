<x-app-layout>
<?php   
    $rubrique = App\Models\Rubrique::where('id', $service->rubrique_id)->first();
    $structure = $service->structures()->first() 
?> 
    <form action="{{ route('requetes.store') }}" method="post">
    @csrf
        <div class="container verification">
            <div class="verification-title">
                {!! $service->libelle !!}
                <input type="hidden" name="service" value="{{ $service->slug }}">
            </div>

            <div class="row">
                <div class="col-md-4 verification-subtitle">Structure:</div> 
                <div class="col-md-8 show-detail">
                    {{$structure->libelle}} 
                    <input type="hidden" name="structure" value="{{ $structure->slug }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 verification-subtitle">Prix:</div> 
                <div class="col-md-8 show-detail"> 
                    {{$service->prix}}  
                </div> 
            </div>

            <div class="row">
                <div class="col-md-4 verification-subtitle">Rubrique:</div> 
                <div class="col-md-8 show-detail">
                    {{ $rubrique->libelle }}
                </div> 
            </div>

            <div class="mt-4 verification-title">
                Résumé 
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

            <div class="row">
                <div class="col-md-6 mt-4">
                    <button type="submit" class="btn btn-custom">
                        {{ __('PAIEMENT') }}
                    </button>
                    <a href="javascript:history.back()" type="button" class="btn btn-warning">
                        {{ __('Modifier') }}
                    </a>
                </div>
            </div>
        </div>
    </form>
        
</x-app-layout>