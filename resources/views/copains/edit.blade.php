@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1">Modifier un copain</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('copains.update', $copain) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" value="{{ old('nom', $copain->nom) }}" class="form-control" id="nom" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" name="prenom" value="{{ old('prenom', $copain->prenom) }}" class="form-control" id="prenom" required>
        </div>

        <div class="mb-3">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input type="text" name="pseudo" value="{{ old('pseudo', $copain->pseudo) }}" class="form-control" id="pseudo" required>
        </div>

        <div class="mb-3">
            <label for="info" class="form-label">Info</label>
            <textarea name="info" class="form-control" id="info">{{ old('info', $copain->info) }}</textarea>
        </div>

        <hr>

        <h4>Informations utilisateur</h4>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" name="email" value="{{ old('email', $copain->user->email ?? '') }}" class="form-control" id="email" required>
        </div>

        {{-- Pas de modification mot de passe ici, gérer ailleurs --}}

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('copains.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
