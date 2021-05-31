<x-dashboard-layout>

<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2><b>LES SERVICES</b></h2></div>

                    <div classe="">
                    <a href="{{route('service.create') }}"> <input type="button" value="AJOUTER"class="btn btn-custom margin_left"></a>
                </div>
                    
                </div>
            </div>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-center">Libellé</th>
                       
                        <th class="text-center"> Structure</th>
                        <th class="text-center">Prix</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($services as $key => $value)
                    <?php
                        $strucure=Structure::where('id',$value->structure_id)->first();      
                    ?>
                    <tr>
                        <td class="text-center">{{ $value->libelle }}</td>
                        <td class='text-center'>{{ $structure->libelle }}</td>    
                        <td class="text-center">{{ $value->prix }}</td>
                        <td class="justify-content-between icon-content text-center">
                            <a href="{{ route('service.show', $value->slug) }}" class="col icon-action detail">
                                <span class="fas fa-info">
                                </span>
                            </a>
                            <a href="{{ route('service.edit', $value->slug) }}" class="col icon-action icon-edit">
                                <span class="fas fa-user-edit edit">
                                </span>
                            </a>
                            <span class="col icon-action">
                                <form  method="POST" action="{{ route('service.destroy', $value->id) }}" class="d-inline-flex">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" onclick="return confirm('Voulez-vous supprimer le service ?')">
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