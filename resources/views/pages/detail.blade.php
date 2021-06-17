<x-app-layout>

<div class="show-title-second padding-block">
            {{ $service->libelle }}
        </div>
    
    <div class="show-detail padding-block descript">
        {{$service->description}}
    </div>
    <div class="show-detail padding-block">
    <?php $structure = $service->structures()->first() ?>
    <span class="infos">Durée</span>:  {{$service->duree}} <span class="infos2">Prix:</span>  {{$service->prix}}  <span class="infos2">Structure:</span>  {{$structure->libelle}}
    </div>
    <div class=" padding-block">
            <h1 class=" text-blue-800 size">Formulaire à remplir</h1>
            <form method="POST" action="{{ route('detail.store') }}">
                    @csrf
                    <div class="row padding-top">
                        <div class="col-md-6 form-group">
                           
                            <input id="num-facture" class="input-custom" type="text" name="num-facture" value="{{ old('num-facture') }}" placeholder="Numéro de facture" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            
                            <input id="montant" class="input-custom" type="text" name="montant" value="{{ old('montant') }}" placeholder="Montant" required />
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <button type="submit" class="btn btn-custom">
                            {{ __('SOUMETTRE') }}
                        </button>
                        <a href="{{ route('resume',$service->slug) }}" type="button" class="btn btn-custom-secondary">
                            {{ __('ANNULER') }}
                        </a>
                    </div>
                </form>
        </div>
</x-app-layout>