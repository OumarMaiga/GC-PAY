<x-dashboard-layout>
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2><b>LES STRUCTURES</b></h2></div>

                    <div classe="">
                    <a href="{{route('structure.create') }}"> <input type="button" value="AJOUTER"class="btn btn-custom margin_left"></a>
                </div>
                    
                </div>
            </div>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                <th scope="col" class="text-center"></th>
                <th scope="col" class="text-center">Structure</th>
                <th scope="col" class="text-center">Type</th>
                <th scope="col" class="text-center">Administrateur</th>
                <th scope="col" class="text-center">Telephone</th>
                <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $n = 0; ?>
                @foreach ($structures as $structure)
                <?php $n = $n + 1; ?>
                    <?php $admin = App\Models\User::where('structure_id', $structure->id)->select('nom', 'prenom')->first() ?> 
                    <tr>
                        <th scope="row"><?= $n ?></th>
                        <td class="text-center">{{ $structure->libelle }}</td>
                        <td class="text-center">{{ $structure->type }}</td>
                        <td class="text-center">
                            @if ($admin != null)
                                {{ $admin->prenom." ".$admin->nom }}
                            @else
                                Non précisé 
                            @endif
                        </td>
                        <td class="text-center">{{ $structure->telephone }}</td>
                        <td class="justify-content-between icon-content text-center">
                            <a href="{{ route('structure.show', $structure->slug) }}" class="col icon-action detail">
                                <span class="fas fa-info">
                                </span>
                            </a>
                            <a href="{{ route('structure.edit', $structure->slug) }}" class="col icon-action icon-edit">
                                <span class="fas fa-user-edit edit">
                                </span>
                            </a>
                            <span class="col icon-action">
                                <form  method="POST" action="{{ route('structure.destroy', $structure->id) }}" class="d-inline-flex">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" onclick="return confirm('Voulez-vous supprimer la structure ?')">
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
</x-dashboard-layout>