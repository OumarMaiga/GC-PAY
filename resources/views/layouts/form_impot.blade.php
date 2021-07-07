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
        <div class="col-md-6 form-group">
            <label for="periode">Période pour laquelle l'impôt ou la taxe est payé (Mois et année)</label>
            <input id="periode" class="input-custom" maxlength='7' name="periode" value="{{ old('periode') }}" placeholder="MM/YYYY" type="text" onkeyup="formatString(event); required ">
            
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 form-group">
            <label for="adresse">Structure</label>
            <select name="structure_id" id="structure_id" class="input-custom">
                <option value="">-- CHOISISSEZ ICI --</option>
                @foreach ($structures as $structure)
                    <option value="{{ $structure->id }}">{{ $structure->libelle }}</option>
                @endforeach
            </select>
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
<script>
function formatString(e) {
  var inputChar = String.fromCharCode(event.keyCode);
  var code = event.keyCode;
  var allowedKeys = [8];
  if (allowedKeys.indexOf(code) !== -1) {
    return;
  }

  event.target.value = event.target.value.replace(
    /^([1-9]\/|[2-9])$/g, '0$1/' // 3 > 03/
  ).replace(
    /^(0[1-9]|1[0-2])$/g, '$1/' // 11 > 11/
  ).replace(
    /^([0-1])([3-9])$/g, '0$1/$2' // 13 > 01/3
  ).replace(
    /^(0?[1-9]|1[0-2])([0-9]{2})$/g, '$1/$2' // 141 > 01/41
  ).replace(
    /^([0]+)\/|[0]+$/g, '0' // 0/ > 0 and 00 > 0
  ).replace(
    /[^\d\/]|^[\/]*$/g, '' // To allow only digits and `/`
  ).replace(
    /\/\//g, '/' // Prevent entering more than 1 `/`
  );
}
</script>