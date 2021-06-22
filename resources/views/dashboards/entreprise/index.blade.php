<x-app-layout>

<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2><b>LES ENTREPRISES</b></h2></div>
                   <!-- <a href="{{route('entreprise.create')}}" class="btn btn-custom"></a> -->
                    
                <div classe="">
                    <a href="{{route('entreprise.create') }}"> <input type="button" value="AJOUTER"class="btn btn-custom margin_left"></a>
                </div>
                </div>
            </div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-center">Raison Social</th>
                        <th class="text-center"> Nif</th>
                        <th class="text-center">Responsable</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 0; ?>
                @foreach($entreprises as $key => $value)
                <?php $n = $n + 1; ?>
               
                    <tr>
                        <td class="text-center"><?= $n ?></td>
                        <td class="text-center">{{ $value->nom }}</td>
                      
                        <td class="text-center">{{ $value->nif }}</td>
                        <td class="text-center">
                        @if ($value->responsable != null)
                                {{ $value->responsable }}
                            @else
                                Non précisé 
                            @endif
                        </td>
                        <td class="justify-content-between icon-content text-center">
                            <a href="{{ route('entreprise.show', $value->slug) }}" class="col icon-action detail">
                                <span class="fas fa-info">
                                </span>
                            </a>
                            <a href="{{ route('entreprise.edit', $value->slug) }}" class="col icon-action icon-edit">
                                <span class="fas fa-user-edit edit">
                                </span>
                            </a>
                            <span class="col icon-action">
                                <form  method="POST" action="{{ route('entreprise.destroy', $value->id) }}" class="d-inline-flex">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" onclick="return confirm('Voulez-vous supprimer l\'administrateur ?')">
                                        <span class="fas fa-user-times supp"></span>
                                    </button>
                                </form>
                            </span>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
           
        </div>
    </div>  
</div>   

</x-app-layout>