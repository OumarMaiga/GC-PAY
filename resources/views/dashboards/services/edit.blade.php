
<x-dashboard-layout>
    <div class="container dashboard-content">
            <div class="content-title">{{ __('MODIFICATION D\'UN SERVICE') }}</div>
    
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
                <form method="POST" action="{{ route('service.update',$service->id) }}">
                    @csrf
                    @method('PUT')
        
                    <!-- Libelle -->
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="libelle">Libelle</label>
                            <input id="libelle" class="input-custom" type="text" name="libelle" value="{{ $service->libelle }}" placeholder="Libelle" required />
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="duree">Durée</label>
                            <input id="duree" class="input-custom" type="text" name="duree" value="{{ $service->duree }}" placeholder="Durée"></input>
                        </div>
                    </div>

                   <!-- Structure et type -->
                    <div class="row mt-2">
                        <div class="col-md-6 form-group">
                                <label for="structure_id">Structure</label>
                                <select name="structures[]" id="strucutres" class="input-custom" multiple="">
                                    @foreach ($structures as $structure)
                                        <?php $ids_structure = $service->structures()->pluck('id')->toArray() ?>
                                        <option <?= (in_array($structure->id, $ids_structure)) ? "selected=selected" : "" ?> value="{{ $structure->id }}">{{ $structure->libelle }}</option>
                                    @endforeach
                                </select>
                        </div>

                        <div class="col-md-6 form-group">
                                <label for="rubrique_id">Rubrique</label>
                                <select name="rubrique_id" id="rubrique_id" class="input-custom">
                                    <option value="">-- CHOISISSEZ ICI --</option>
                                    @foreach ($rubriques as $rubrique)
                                        <option <?= ($service->rubrique_id == $rubrique->id) ? "selected=selected" : "" ?> value="{{ $rubrique->id }}">{{ $rubrique->libelle }}</option>
                                    @endforeach
                                </select>
                        </div>                   
                    </div>

                     
                     <div class="row mt-2">
                        <div class="col-md-6 form-group">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="input-custom">
                                <option value="">-- CHOISISSEZ ICI --</option>
                                <option <?= ($service->type == "paiement") ? "selected=selected" : "" ?> value="paiement">Paiement</option>
                                <option <?= ($service->type == "demande") ? "selected=selected" : "" ?> value="demande">Demande</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="prix">Prix</label>
                            <input id="prix" class="input-custom" type="text" name="prix" value="{{ $service->prix }}" placeholder="Prix" />
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12 form-group">
                            <label for="description">Description</label>
                            <textarea id="description" class="input-custom" type="text" name="description" placeholder="Description,details">{{$service->description}}</textarea>
                        </div>
                    </div>
                     
                    <div class="col-md-6 mt-4">
                        <button type="submit" class="btn btn-custom">
                            {{ __('MODIFIER') }}
                        </button>
                        <a href="{{ route('service.index') }}" type="button" class="btn btn-custom-secondary">
                            {{ __('ANNULER') }}
                        </a>
                    </div>
                </form>
    </div>
    
    <script>
        tinymce.init({
          selector: '#description',
         
          plugins: [
            "code advlist  autolink lists link "
            ],
          toolbar: 'code |undo redo styleselect bold italic alignleft aligncenter alignright alignjustify | bullist numlist outdent indent'
            });
    </script>
</x-dashboard-layout>
