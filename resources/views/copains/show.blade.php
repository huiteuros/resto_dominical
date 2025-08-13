@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails du copain</h1>

    <div class="mb-3">
        <strong>Nom :</strong> {{ $copain->nom }}
    </div>
    <div class="mb-3">
        <strong>Prénom :</strong> {{ $copain->prenom }}
    </div>
    <div class="mb-3">
        <strong>Pseudo :</strong> {{ $copain->pseudo }}
    </div>
    <div class="mb-3">
        <strong>Info :</strong> {{ $copain->info ?? '—' }}
    </div>
    <div class="mb-3">
        <strong>Email :</strong> {{ $copain->user->email ?? '—' }}
    </div>

    <a href="{{ route('copains.edit', $copain) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('copains.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
