<x-app-layout>

    <div class="show-title-second padding-block">
        {!! $service->libelle !!}
    </div>
    
    <div class="show-detail padding-block descript">
        {!! $service->description !!}
    </div>

    <div class="show-detail padding-block">
        <?php $structure = $service->structures()->first() ?>
        <span class="infos">Durée</span>:  {{$service->duree}} 
        <span class="infos2">Prix:</span>  {{$service->prix}}  
        <span class="infos2">Structure:</span>  
        @if($structures->count() == 0)
            Non précisée
        @elseif($structures->count() == 1)
            @foreach ($structures as $structure)
                {{ $structure->libelle }}
            @endforeach
        @else
            <div class="dropdown d-inline">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Cliquez pour voir
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach ($structures as $structure)
                        <a class="dropdown-item" href="#">{{ $structure->libelle }}</a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
    
    @if(Auth::check())
    <div class=" padding-block">
        <h1 class=" text-blue-800 size">Formulaire à remplir</h1>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <!--Formulaire pour la rubrique eau et electricité -->
        @if($rubrique->slug=="eau-et-electricité")
            @include('layouts.form_eau_electricite')
        @endif


        <!--Formulaire pour la rubrique impôts et taxes -->
        @if($rubrique->slug=="impots-et-taxes")
            @include('layouts.form_impot')
        @endif  


        <!--Formulaire pour la rubrique automobile -->
        @if($rubrique->slug=="automobile")
            @include('layouts.form_vignette')
        @endif

        <!--Formulaire pour le service carte d'identité -->
        @if($service->slug=="carte-national-didentite")
            @include('layouts.form_carte_didentite')
        @endif

        <!--Formulaire pour le service passport -->
        @if($service->slug=="passport")
            @include('layouts.form_passport')
        @endif

    </div>
    @else
    <div class="padding-block">
        <form action="{{ route('requete.store') }}" method="post">
            @csrf
            <input type="submit" value="DEMANDER LE SERVICE"class="btn btn-custom">
        </form>
    </div>
    @endif
</x-app-layout>