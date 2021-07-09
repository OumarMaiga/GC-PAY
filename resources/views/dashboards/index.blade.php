<x-dashboard-layout>
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card-content">
                    <h1 class="title-card">{{ $structure->libelle }}</h1>
                    <div class="card-description">
                        <p>{{ $structure->email }}</p>
                        <p>{{ $structure->telephone }}</p>
                        <p>{{ $structure->adresse }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card-content card-agent">
                    <div class="row">
                        <div class="col-4">
                            <div class="card-number">
                                {{ $nbre_agent }}
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="card-lil-title">
                                Agent<?= ($nbre_agent > 1) ? "s" : "" ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-content card-service">
                    <div class="row">
                        <div class="col-4">
                            <div class="card-number">
                                {{ $nbre_service }}
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="card-lil-title">
                                Service<?= ($nbre_service > 1) ? "s" : "" ?>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-content card-demande">
                    <div class="row">
                        <div class="col-4">
                            <div class="card-number">
                                {{ $nbre_demande }}
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="card-lil-title">
                                Demande<?= ($nbre_demande > 1) ? "s" : "" ?>
                            </div>
                            <p>
                                En attente ...
                            </p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>