<x-dashboard-layout>
    <div class="container-xl dashboard-content">
            @if(Auth::user()->type == "admin-structure" || Auth::user()->type == "agent")
                
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
                        <div class="card-content card-blue">
                            <div class="card-lil-title">
                                Agent<?= ($nbre_agent > 1) ? "s" : "" ?>
                            </div>
                            <div class="card-number">
                                {{ $nbre_agent }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-content card-green">
                            <div class="card-lil-title">
                                Service<?= ($nbre_service > 1) ? "s" : "" ?>
                            </div>
                            <div class="card-number">
                                {{ $nbre_service }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-content card-rose">
                            <div class="card-lil-title">
                                Demande<?= ($nbre_demande > 1) ? "s" : "" ?>
                            </div>
                            <div class="card-number">
                                {{ $nbre_demande }}<span class="attente">En attente ...</span>
                            </div>
                        </div>
                    </div>
                </div>

            @elseif(Auth::user()->type == "admin-systeme")
                <div class="row">
                    <div class="col-md-4">
                        <div class="card-content card-blue">
                            <div class="card-lil-title">
                                Administrateur<?= ($nbre_admin > 1) ? "s" : "" ?>
                            </div>
                            <div class="card-number">
                                {{ $nbre_admin }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-content card-green">
                            <div class="card-lil-title">
                                Structure<?= ($nbre_structure > 1) ? "s" : "" ?>
                            </div>
                            <div class="card-number">
                                {{ $nbre_structure }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-content card-rose">
                            <div class="card-lil-title">
                                Rubrique<?= ($nbre_rubrique > 1) ? "s" : "" ?>
                            </div>
                            <div class="card-number">
                                {{ $nbre_rubrique }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card-content card-green">
                            <div class="card-lil-title">
                                Service<?= ($nbre_service > 1) ? "s" : "" ?>
                            </div>
                            <div class="card-number">
                                {{ $nbre_service }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-content card-rose">
                            <div class="card-lil-title">
                                Entreprise<?= ($nbre_entreprise > 1) ? "s" : "" ?>
                            </div>
                            <div class="card-number">
                                {{ $nbre_entreprise }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-content card-blue">
                            <div class="card-lil-title">
                                Utilisateur<?= ($nbre_usager > 1) ? "s" : "" ?>
                            </div>
                            <div class="card-number">
                                {{ $nbre_usager }}
                            </div>
                        </div>
                    </div>
                </div>
            @else
            
            @endif
    </div>
</x-dashboard-layout>