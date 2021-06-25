<x-app-layout>
    <div class="container dashboard-content">
            <div class="content-title">{{ __('CREATION D\'UNE REQUÊTE') }}</div>
    
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
                <form method="POST" action="{{ route('requete.store') }}">
                    @csrf
        
                 
                  

                   <!-- Structure et service -->
                    <div class="row mt-2">
                        <div class="col-md-6 form-group">
                                <label for="structure_id">Structure</label>
                                <select name="structure_id" id="strucutre_id" class="input-custom">
                                    <option value="">-- CHOISISSEZ ICI --</option>
                                    @foreach ($structures as $structure)
                                        <option value="{{ $structure->id }}">{{ $structure->libelle }}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="col-md-6 form-group">
                                <label for="service_id">Service</label>
                                <select name="service_id" id="service_id" class="input-custom">
                                    <option value="">-- CHOISISSEZ ICI --</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->libelle }}</option>
                                    @endforeach
                                </select>
                        </div>
                        
                    
                    </div>
                     
                    <div class="col-md-6 mt-4">
                        <button type="submit" class="btn btn-custom">
                            {{ __('AJOUTER') }}
                        </button>
                        <a href="{{ route('service.index') }}" type="button" class="btn btn-custom-secondary">
                            {{ __('ANNULER') }}
                        </a>
                    </div>
                </form>
    </div>

</x-app-layout>