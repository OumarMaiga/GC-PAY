
<div class="row">
    <div class="col-md-4 verification-subtitle">Numero de chassis:</div>
    <div class="col-md-8 show-detail">
        {{ $data['numero_chassis'] }}
    </div> 
</div>
<div class="row">
    <div class="col-md-4 verification-subtitle">Documents:</div>
    <div class="col-md-8 show-detail">
        @include('layouts.link_document')
    </div>
</div>