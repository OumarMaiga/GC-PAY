<x-app-layout>
    <div class="bg-image" style="background-image: url('https://koulouba.ml/wp-content/uploads/2021/02/MALI_Koulouba.jpg'); height:700px ; background-size:100% 100%; margin:0;
  padding:0;">
        <div class="mask rgba-blue-light" style="background-color:  rgb(37, 150, 190,0.6) ; height: 700px">
            <div class="d-flex justify-content-center align-items-center h-100">
                <h1 class="text-white mb-0 text-grand text-center">DESORMAIS EN LIGNE,PAYER VOS <br> RECETTES FISCALES</h1>
            </div>
        </div>
    </div>
    <div class="accordion" id="accordionExample">
        @foreach($rubriques as $key => $value)
            <?php $services = App\Models\Service::where('rubrique_id', $value->id)->get()?> 
            <div class="rubrique-item-container">
                <h3 class="rubrique-item-title" type="button" data-toggle="collapse" data-target="#{{$value->slug}}" aria-expanded="true" aria-controls="collapseOne">
                        {{$value->libelle}} <i class="fas fa-angle-down rotate-icon"></i>
                    <hr>
                </h3>

                <div id="{{$value->slug}}" class="collapse show" aria-labelledby="{{$value->slug}}" data-parent="#accordionExample">
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