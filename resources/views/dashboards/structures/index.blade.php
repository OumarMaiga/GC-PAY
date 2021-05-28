<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="mb-3 row align-items-center">
            <div class="col">
                <span class="content-title">STRUCTURES</span>
                <a href="{{ route('structure.create') }}" class="float-right"><button class="btn btn-custom">AJOUTER</button></a>
            </div>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Structure</th>
                <th scope="col">Type</th>
                <th scope="col">Administrateur</th>
                <th scope="col">Telephone</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($structures as $structure)
                    <tr>
                        <th scope="row">1</th>
                        <td>{{ $structure->libelle }}</td>
                        <td>{{ $structure->type }}</td>
                        <td>Ousmane Toure</td>
                        <td>{{ $structure->telephone }}</td>
                        <td class="justify-content-between icon-content">
                            <a href="" class="col icon-action detail">
                                <span class="fas fa-info">
                                </span>
                            </a>
                            <a href="" class="col icon-action icon-edit">
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
</x-dashboard-layout>