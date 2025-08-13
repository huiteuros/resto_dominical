@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter un copain</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('copains.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" value="{{ old('nom') }}" class="form-control" id="nom" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" name="prenom" value="{{ old('prenom') }}" class="form-control" id="prenom" required>
        </div>

        <div class="mb-3">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input type="text" name="pseudo" value="{{ old('pseudo') }}" class="form-control" id="pseudo" required>
        </div>

        <div class="mb-3">
            <label for="info" class="form-label">Info</label>
            <textarea name="info" class="form-control" id="info">{{ old('info') }}</textarea>
        </div>

        <hr>

        <h4>Informations utilisateur</h4>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-success">Créer</button>
    </form>
</div>
@endsection
