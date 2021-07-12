
<x-app-layout>
    <div class="container dashboard-content">
            <div class="content-title">{{ __('CREATION D\'UNE ENTREPRISE') }}</div>
    
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
                <form method="POST" action="{{ route('entreprise.store') }}">
                    @csrf
        
                    <!-- Nom -->
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="nom">Raison social</label>
                            <input id="nom" class="input-custom" type="text" name="nom" value="{{ old('nom') }}" placeholder="Nom" required />
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="nif">NIF</label>
                            <input id="nif" class="input-custom" type="text" name="nif" value="{{ old('nif') }}" placeholder="Numéro d'identification fiscale" required/>
                        </div>
                    </div>

                   <!-- creation et telephone -->
                    <div class="row mt-2">
                        <div class="col-md-6 form-group">
                            <label for="date_creation">Date de création (Mois et année)</label>
                            
                            <input id="date_creation" class="input-custom" maxlength='7' name="date_creation" value="{{ old('date_creation') }}" placeholder="MM/YYYY" type="text" onkeyup="formatString(event);">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="responsable">Responsable</label>
                            <input id="responsable" class="input-custom" type="text" name="responsable" value="{{ old('responsable') }}" placeholder="Prenom et Nom" required/>
                        </div>
                        
                    </div>
                     <div class="row mt-2">
                        <div class="col-md-6 form-group">
                            <label for="adresse">Adresse</label>
                            <textarea id="adresse" class="input-custom" type="text" name="adresse" value="" placeholder="Ville, Commune, Quartier">{{ old('adresse') }}</textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="telephone">Telephone</label>
                            <input id="telephone" class="input-custom" type="text" name="telephone" value="{{ old('telephone') }}" placeholder="N° Telephone" />
                        </div>
                        
                        
                    </div>

                     
                    <div class="col-md-6 mt-4">
                        <button type="submit" class="btn btn-custom">
                            {{ __('AJOUTER') }}
                        </button>
                        <a href="{{ route('entreprise.index') }}" type="button" class="btn btn-custom-secondary">
                            {{ __('ANNULER') }}
                        </a>
                    </div>
                </form>
    </div>
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
</x-app-layout>
