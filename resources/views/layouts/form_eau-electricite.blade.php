<form method="POST" action="{{ route('service.verification', $service->slug) }}">
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
                <a href="{{ route('accueil') }}" type="button" class="btn btn-custom-secondary">
                    {{ __('ANNULER') }}
                </a>
            </div>
        </form>