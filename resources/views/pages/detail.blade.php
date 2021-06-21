<x-app-layout>

    <div class="show-title-second padding-block">
        {!! $service->libelle !!}
    </div>
    
    <div class="show-detail padding-block descript">
        {!! $service->description !!}
    </div>

    <div class="show-detail padding-block">
        <?php $structure = $service->structures()->first() ?>
        <span class="infos">Durée</span>:  {{$service->duree}} <span class="infos2">Prix:</span>  {{$service->prix}}  <span class="infos2">Structure:</span>  {{ ($structure != null) ? $structure->libelle : ""}}
    </div>
    
    <div class=" padding-block">
        <h1 class=" text-blue-800 size">Formulaire à remplir</h1>

        <!--Formulaire pour la rubrique eau et electricité -->
        @if($rubrique->slug=="eau-et-electricité")
        @include('layouts.form_eau-electricite')
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
        @include('layouts.form_carte-identite')
       
        @endif

        <!--Formulaire pour le service passport -->
        @if($service->slug=="passport")
        @include('layouts.form_passport')
        @endif

    </div>
</x-app-layout>