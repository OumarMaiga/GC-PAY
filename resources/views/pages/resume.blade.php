<x-app-layout>
<?php   
    $rubrique = App\Models\Rubrique::where('id', $service->rubrique_id)->first();
    $structure = $service->structures()->first() 
?> 
        <div class="show-title-second padding-block">
            <span class="uppercase">  {!! $service->libelle !!}</span>
        </div>

        <div class="show-detail padding-block row">
        <div class="col-md-1"> <b><u>Structure</u></b>:</div> 
        {{$structure->libelle}} 
        </div>

        <div class="show-detail padding-block row">
        <div class="col-md-1"> <b><u>Prix:</u></b></div>  
        {{$service->prix}}  
        </div>

        <div class="show-detail padding-block row">
        <div class="col-md-1"> <b><u>Rubrique:</u></b></div> 
        {{ $rubrique->libelle }}
        </div>

        <div class="show-title-second padding-block">
            RESUME
        </div>
        <div class="show-detail padding-block row">
        <div class="col-md-2"> <b><u>Numéro de Facture:</u></b> </div>
        </div>

        <div class="show-detail padding-block row">
        <div class="col-md-2"> <b><u>Prix:</u></b></div>
        </div>

        <div class="col-md-6 mt-4">
                        <a href="#" type="button" class="btn btn-custom padding-block">
                            {{ __('PAIEMENT') }}
                        </a>
        </div>
        
</x-app-layout>