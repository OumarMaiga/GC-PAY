<x-app-layout>
<h1 class="text-gray-500 mb-0 text-grand text-center">RESULTATS DE VOS RECHERCHES </h1>
<div class="show-detail padding-block "> Les services correspondant sont: </br>
@foreach($services as $service)
<a href="{{ route('detail',$service->slug) }}" class="service-item-link">
                                   <span class="text-blue-800"> {!! $service->libelle !!}</span>
                                </a> </br>
@endforeach
</div>
<div class="accordion" id="accordionExample">
        @foreach($rubriques as $key => $value)
            <?php $services = App\Models\Service::where('rubrique_id', $value->id)->get()?> 
            <div class="rubrique-item-container">
                <h3 class="rubrique-item-title" type="button" data-toggle="collapse" data-target="#{{$value->slug}}" aria-expanded="true" aria-controls="{{$value->slug}}">
                        {{$value->libelle}} <i class="fas fa-angle-down rotate-icon"></i>
                    <hr>
                </h3>

                <div id="{{$value->slug}}" class="collapse  show" aria-labelledby="{{$value->slug}}" >
                    <div class="row">
                            @foreach($services as $key => $value)
                            <div class="col-md-4 mt-4">
                                <a href="{{ route('detail',$value->slug) }}" class="service-item-link">
                                    {!! $value->libelle !!}
                                </a>
                            </div>
                            @endforeach
                    </div>
                </div>
            </div>
        @endforeach
        
            
    </div>


</x-app-layout>