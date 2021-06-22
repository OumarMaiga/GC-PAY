<div class="row">
    <div class="col-md-4 verification-subtitle">Entreprise:</div>
    <div class="col-md-8 show-detail">
        {{ $entreprise->nom }}
    </div> 
</div>

<div class="row">
    <div class="col-md-4 verification-subtitle">Montant declarer:</div>
    <div class="col-md-8 show-detail">
        {{ $data['montant_declarer'] }}
    </div> 
</div><div class="row">
    <div class="col-md-4 verification-subtitle">Montant payer:</div>
    <div class="col-md-8 show-detail">
        {{ $data['montant_payer'] }}
    </div> 
</div>

<div class="row">
    <div class="col-md-4 verification-subtitle">Periode:</div>
    <div class="col-md-8 show-detail">
        {{ $data['periode'] }}
    </div> 
</div>