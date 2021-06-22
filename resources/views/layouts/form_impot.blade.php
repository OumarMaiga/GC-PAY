<form method="POST" action="{{ route('service.verification', $service->slug) }}">
    @csrf
    
    <div class="row padding-top">
        <div class="col-md-6 form-group">
            <label for="entreprise">Entreprise</label>
            <select name="entreprise_id" id="entreprise_id" class="input-custom">
                <option value="">-- CHOISISSEZ ICI --</option>
                @foreach ($entreprises as $entreprise)
                    <option value="{{ $entreprise->id }}">{{ $entreprise->nom }}</option>
                @endforeach
                
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="montant_declarer">Montant déclaré</label>
            <input id="montant_declarer" class="input-custom" type="text" name="montant_declarer" value="{{ old('montant_declarer') }}" placeholder="Montant déclaré" required />
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="montant_payer">Montant à payer</label>
            <input id="montant_payer" class="input-custom" type="text" name="montant_payer" value="{{ old('montant_payer') }}" placeholder="Montant Payé" required />
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="periode">Période pour laquelle l'impôt ou la taxe est payé (Mois et année)</label>
            <input id="periode" class="input-custom" type="month" name="periode" value="{{ old('periode') }}" placeholder="Ex: Janvier 2021" required />
            
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