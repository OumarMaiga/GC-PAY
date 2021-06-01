<x-dashboard-layout>
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2><b>LES RUBRIQUES</b></h2></div>

                    <div classe="">
                    <a href="{{route('rubrique.create') }}"> <input type="button" value="AJOUTER"class="btn btn-custom margin_left"></a>
                </div>
                    
                </div>
            </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <table class="table table-hover table-striped table-bordered">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col" class="text-center">Libelle</th>
                <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $n = 0; ?>
                @foreach ($rubriques as $rubrique)
                <?php $n = $n + 1; ?>
                    <tr>
                        <th scope="row"><?= $n ?></th>
                        <td class="text-center">{{ $rubrique->libelle }}</td>
                        <td class="justify-content-between icon-content text-center">
                            <a href="{{ route('rubrique.show', $rubrique->slug) }}" class="col icon-action detail">
                                <span class="fas fa-info">
                                </span>
                            </a>
                            <a href="{{ route('rubrique.edit', $rubrique->slug) }}" class="col icon-action icon-edit">
                                <span class="fas fa-user-edit edit">
                                </span>
                            </a>
                            <span class="col icon-action">
                                <form  method="POST" action="{{ route('rubrique.destroy', $rubrique->id) }}" class="d-inline-flex">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" onclick="return confirm('Voulez-vous supprimer cet rubrique ?')">
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