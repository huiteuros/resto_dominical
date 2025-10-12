@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1">Modifier mon avis pour : {{ $lieu->nom }}</h1>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $lieu->nom }}</h5>
            <p class="card-text">
                <strong>Type :</strong> {{ $lieu->type->nom }}<br>
                <strong>Adresse :</strong> {{ $lieu->adresse ?? 'Non renseignée' }}
            </p>
        </div>
    </div>

    <form action="{{ route('avis.update', [$lieu, $avis]) }}" method="POST">
        @csrf
        @method('PUT')
        @include('avis.partials.form')
        <button type="submit" class="btn btn-success">Mettre à jour mon avis</button>
        <a href="{{ route('avis.index', $lieu) }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
