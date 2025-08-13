@extends('layouts.app')

@section('content')
<h1>Détails du repas</h1>

<p><strong>Restaurant :</strong> {{ $amange->restopasse->restaurant->nom_restau }}</p>
<p><strong>Date :</strong> {{ $amange->restopasse->date_sortie->format('d/m/Y') }}</p>
<p><strong>Prix :</strong> {{ $amange->prix ?? 'N/A' }}</p>
<p><strong>Qualité nourriture :</strong> {{ $amange->qualite_nourriture ?? 'N/A' }}</p>
<p><strong>Ambiance :</strong> {{ $amange->ambiance ?? 'N/A' }}</p>
<p><strong>Note globale :</strong> {{ $amange->overall ?? 'N/A' }}</p>
<p><strong>Avis :</strong> {{ $amange->avis ?? '-' }}</p>

<a href="{{ route('amange.index') }}" class="btn btn-secondary">Retour à la liste</a>
<a href="{{ route('amange.crudedit', ['id_copain' => $amange->id_copain, 'id_restopasse' => $amange->id_restopasse]) }}" class="btn btn-warning btn-sm">Modifier</a>
@endsection
