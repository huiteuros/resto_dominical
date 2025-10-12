@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1">Détails du lieu</h1>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $lieu->nom }}</h5>
            <p class="card-text">
                <strong>Type :</strong> {{ $lieu->type->nom }}<br>
                <strong>Adresse :</strong> {{ $lieu->adresse ?? 'Non renseignée' }}
            </p>
            @if($lieu->avis->count() > 0)
                <hr>
                <p class="card-text">
                    <strong>Nombre d'avis :</strong> {{ $lieu->avis->count() }}<br>
                    @php
                        $moyenneNote = $lieu->avis->avg('note_general');
                        $nbRecommandations = $lieu->avis->where('reco', true)->count();
                    @endphp
                    @if($moyenneNote)
                        <strong>Note moyenne :</strong> {{ number_format($moyenneNote, 1) }}/5 <span class="text-warning">★</span><br>
                    @endif
                    <strong>Recommandations :</strong> {{ $nbRecommandations }} / {{ $lieu->avis->count() }}
                </p>
            @endif
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('avis.index', $lieu) }}" class="btn btn-primary">Voir les avis</a>
        <a href="{{ route('lieux.edit', $lieu) }}" class="btn btn-warning">Modifier</a>
        <a href="{{ route('lieux.index') }}" class="btn btn-secondary">Retour</a>
        <form action="{{ route('lieux.destroy', $lieu) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" onclick="return confirm('Supprimer ce lieu ?')">Supprimer</button>
        </form>
    </div>
</div>
@endsection
