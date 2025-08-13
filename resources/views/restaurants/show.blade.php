@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $restaurant->nom_restau }}</h1>
    <p><strong>Type :</strong> {{ $restaurant->type_restau }}</p>
    <p><strong>Adresse :</strong> {{ $restaurant->adresse_postale }}</p>
    <p><strong>Site web :</strong> <a href="{{ $restaurant->lien_site_web }}" target="_blank">{{ $restaurant->lien_site_web }}</a></p>
    <p><strong>Ouvert dimanche midi :</strong> {{ $restaurant->ouvert_dimanche_midi ? 'Oui' : 'Non' }}</p>
    <a href="{{ route('restaurants.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
