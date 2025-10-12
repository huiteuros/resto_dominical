@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1">Détails du type</h1>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $type->nom }}</h5>
            <p class="card-text">
                <strong>Nombre de lieux :</strong> {{ $type->lieux->count() }}
            </p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('types.edit', $type) }}" class="btn btn-warning">Modifier</a>
        <a href="{{ route('types.index') }}" class="btn btn-secondary">Retour</a>
        <form action="{{ route('types.destroy', $type) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" onclick="return confirm('Supprimer ce type ?')">Supprimer</button>
        </form>
    </div>
</div>
@endsection
