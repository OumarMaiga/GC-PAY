<x-app-layout>

    <div class="padding-top-second container ">
        <h2 class="text-center text-gray-500">Montant à payer</h2>
    <div class="show-title-second text-center">
        @if (array_key_exists('montant_payer', $data))
            {{ $data['montant_payer'] }}
        @elseif (array_key_exists('montant', $data))
            {{ $data['montant'] }}
        @else
            <?= App\Models\Service::findOrFail($data['service_id'])->prix ?>
        @endif
        F
    </div>

        <div class="row  justify-content-center">
            <div class="accordion padding-top-second col-md-4 " id="accordionExample">
                <!--Ouverture du formulaire depuis ce niveau mais les champs seront mis dans les card-body -->
                
                <form method="POST" action="{{ route('paiement.choix') }}">
                @csrf
                @method('POST')
                    <div class="card border-transparent">
                        <div class="card-header " id="headingOne">
                            <h5>
                            <input class="btn btn-link" type="radio" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"  name="choix" value="credit_card"/>
                                <span class="show-detail padding-block ">Carte de Crédit </span>
                            
                                <img src="https://img2.freepng.fr/20180523/wqt/kisspng-mastercard-credit-card-american-express-visa-debit-mbna-5b0525b571e990.8787905215270639894666.jpg" class="img-paie float-right "  alt=""/>
                            </h5>
                        </div>
                    </div>
                    <div class="card mt-3 border-transparent">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0"> 
                            <input class="btn btn-link collapsed" type="radio" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" name="choix" value="orange_money"/>
                                <span class="show-detail padding-block"> Orange Money </span>
                                <img src="https://www.widjam.com/imgs/244.png" class="img-paie float-right" alt=""/>
                            </h5>
                        </div>
                    </div>
                    <div class="card mt-3 border-transparent">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                            <input class="btn btn-link collapsed" type="radio" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"  name="choix" value="moov_money"/>
                                <span class="show-detail padding-block">  Mobicash </span>
                                <img src="https://pbs.twimg.com/profile_images/1344795632112988160/-4P5-m8B_400x400.jpg" class="img-paie float-right" alt=""/>
                            </h5>
                        </div>
                    </div>
                    <div class="mt-4 justify-content-center">
                        <button type="submit" class="btn btn-custom full">
                            {{ __('PAIEMENT') }}
                        </button>
                    </div>  
                </form>
            </div>
        </div>
    </div>
</x-app-layout>