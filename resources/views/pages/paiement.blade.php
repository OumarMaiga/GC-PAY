<x-app-layout>

    <div class="padding-top-second container ">
        <h2 class="text-center text-gray-500">Montant à payer</h2>
        <div class="show-title-second text-center">
            10.000
        </div>

        <div class="row  justify-content-center ">
            <div class="accordion padding-top-second col-md-4 " id="accordionExample">
                <!--Ouverture du formulaire depuis ce niveau mais les champs seront mis dans les card-body -->

                    <div class="card border-transparent">
                        <div class="card-header " id="headingOne">
                            <h5 class="mb-0">
                            <input class="btn btn-link" type="radio" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"  name="paye"/>
                                <span class="show-detail padding-block">Carte de Crédit </span>
                                <img src="https://img2.freepng.fr/20180523/wqt/kisspng-mastercard-credit-card-american-express-visa-debit-mbna-5b0525b571e990.8787905215270639894666.jpg" class="img-paie-media float-right" alt=""/>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" >
                            <div class="card-body ">
                            <!-- champs du formulaire -->
                            <div class="form-group">      
                                <label for="numero_carte"> Numéro de la carte</label>
                                <input id="numero_carte" class="input-custom" type="text" name="numero_carte" value="{{ old('numero_carte')}}" placeholder="Numéro de la carte" required />
                                        
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                <label for="code_securite"> Code de sécurité</label>
                                <input id="code_securite" class="input-custom" type="text" name="code_securite" value="{{ old('code_securite')}}" placeholder="Code de sécurité" required />
                                </div>
                                <div class="col-md-6 form-group">
                                <label for="date_expiration"> Date d'expiration</label>
                                <input id="date_expiration" class="input-custom" type="text" name="date_expiration" value="{{ old('date_expiration')}}" placeholder="Date expiration" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3 border-transparent">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0"> 
                            <input class="btn btn-link collapsed" type="radio" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" name="paye"/>
                                <span class="show-detail padding-block"> Orange Money </span>
                                <img src="https://www.widjam.com/imgs/244.png" class="img-paie-media float-right" alt=""/>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" >
                            <div class="card-body">
                            <!-- champs du formulaire -->
                            <div class="form-group">        
                                <label for="telephone"> Numéro de téléphone</label>
                                <input id="telephone" class="input-custom" type="text" name="telephone" value="{{ old('telephone')}}" placeholder="Numéro de téléphone" required />      
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3 border-transparent">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                            <input class="btn btn-link collapsed" type="radio" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"  name="paye"/>
                                <span class="show-detail padding-block">  Mobicash </span>
                                <img src="https://www.rocketremit.com/wp-content/uploads/2020/04/mc_ml.png" class="img-paie-media float-right" alt=""/>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" >
                            <div class="card-body ">
                            <!-- champs du formulaire -->
                            <div class="form-group">         
                                <label for="telephone"> Numéro de téléphone</label>
                                <input id="telephone" class="input-custom" type="text" name="telephone" value="{{ old('telephone')}}" placeholder="Numéro de téléphone" required />              
                            </div>
                            </div>
                        </div>
                    </div>
                <form method="POST" action="{{ route('requete.store') }}">
                @csrf
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