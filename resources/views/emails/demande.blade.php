<div style="margin: 1rem 2rem;">    
    <img src="{{ asset('images/logo_small.png') }}" style=" width: 150px; background-color:#1C5EC2" >
    <div class="">
        <h2 style="font-size: 2rem;">Bonjour {{ "$user->nom $user->prenom," }}</h2>
        <p style="font-size: 1.6rem">
            {{ "$description" }}
        </p>
    </div>
</div>