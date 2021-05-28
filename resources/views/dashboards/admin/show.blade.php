<x-dashboard-layout>
<h1>Showing {{ $user->nom }}</h1>

<div class="jumbotron text-center">
    <h2>{{ $user->name }}</h2>
    <p>
        <strong>Nom:</strong> {{ $user->nom }}<br>
        <strong>Prenom:</strong> {{ $user->prenom }}<br>
        <strong>Email:</strong> {{ $user->email }}<br>
        <strong>Adresse:</strong> {{ $user->adresse }}
    </p>
</div>

</x-dashboard-layout>