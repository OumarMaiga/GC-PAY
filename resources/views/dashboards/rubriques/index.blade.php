<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="mb-3 row align-items-center">
            <div class="col">
                <span class="content-title">RUBRIQUE</span>
                <a href="{{ route('rubrique.create') }}" class="float-right"><button class="btn btn-custom">AJOUTER</button></a>
            </div>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Libelle</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $n = 0; ?>
                @foreach ($rubriques as $rubrique)
                <?php $n = $n + 1; ?>
                    <tr>
                        <th scope="row"><?= $n ?></th>
                        <td>{{ $rubrique->libelle }}</td>
                        <td class="justify-content-between icon-content">
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
</x-dashboard-layout>