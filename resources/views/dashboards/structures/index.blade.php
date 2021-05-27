<x-dashboard-layout>
    <div class="container content">
        <h3 class="mb-3 align-items-start content-title">
                LES DIPLOMES
                <a href="" class="float-right"><button class="btn-custom">AJOUTER</button></a>
            </div>
        </h3>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Structure</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>La strucutre</td>
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
                                <span class="fas fa-user-times supp"></span>
                            </span>
                            
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>
</x-dashboard-layout>