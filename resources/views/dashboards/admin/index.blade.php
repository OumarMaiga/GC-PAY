<x-dashboard-layout>

<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2><b>LES ADMINISTRATEURS DES STRUCTURES</b></h2></div>

                    <div classe="">
                    <a href="{{route('admin.create') }}"> <input type="button" value="AJOUTER"class="btn btn-custom margin_left"></a>
                </div>
                    
                </div>
            </div>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-center">Nom</th>
                        <th class="text-center"> Prenom</th>
                        <th class="text-center"> email</th>
                        <th class="text-center">telephone</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $key => $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->nom }}</td>
                        <td>{{ $value->prenom }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->telephone }}</td>
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
                                <form  method="POST" action="{{ route('admin.destroy', $value->id) }}" class="d-inline-flex">
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

</x-dashboard-layout>