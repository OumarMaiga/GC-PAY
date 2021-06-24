<x-dashboard-layout>

<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2><b>LES SERVICES</b></h2></div>
                    @if (Auth::user()->type == "admin-systeme")
                        <a href="{{route('service.create') }}"> <input type="button" value="AJOUTER"class="btn btn-custom margin_left"></a>
                    @endif
                </div>
            </div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-center">Libellé</th>
                       @if (Auth::user()->type == "admin-systeme")
                            <th class="text-center"> Structure</th>
                       @endif
                        <th class="text-center"> Rubrique</th>
                        <th class="text-center">Prix</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 0; ?>
                @foreach($services as $service)
                <?php
                    $n = $n + 1;
                    $structures = $service->structures()->get();

                    $rubrique = $service->rubrique()->associate($service->rubrique_id)->rubrique
                ?>
                        <tr>
                        <td class="text-center">{{ $n }}</td>
                        <td class="text-center">{!! $service->libelle !!}</td>
                        
                       @if (Auth::user()->type == "admin-systeme")
                            <td class="text-center">
                                @if($structures->count() == 0)
                                    Non précisée
                                @elseif($structures->count() == 1)
                                    @foreach ($structures as $structure)
                                        {{ $structure->libelle }}
                                    @endforeach
                                @else
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Structures
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            @foreach ($structures as $structure)
                                                <a class="dropdown-item" href="#">{{ $structure->libelle }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </td>
                        @endif
                        @if($rubrique == NULL)
                            <td class="text-center">Non précisée</td>
                        @else
                            <td class="text-center">{{ $rubrique->libelle }}</td>
                        @endif
                        <td class="text-center">{{ $service->prix }}</td>
                        <td class="justify-content-between icon-content text-center">
                            <a href="{{ route('service.show', $service->slug) }}" class="col icon-action detail">
                                <span class="fas fa-info">
                                </span>
                            </a>
                            @if (Auth::user()->type == "admin-systeme")
                                <a href="{{ route('service.edit', $service->slug) }}" class="col icon-action icon-edit">
                                    <span class="fas fa-user-edit edit">
                                    </span>
                                </a>
                                <span class="col icon-action">
                                    <form  method="POST" action="{{ route('service.destroy', $service->id) }}" class="d-inline-flex">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" onclick="return confirm('Voulez-vous supprimer le service ?')">
                                            <span class="fas fa-user-times supp"></span>
                                        </button>
                                    </form>
                                </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
           
        </div>
    </div>  
</div>   

</x-dashboard-layout>