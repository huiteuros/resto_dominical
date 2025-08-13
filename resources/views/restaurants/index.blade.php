@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1">Liste des restaurants</h1>
    <a href="{{ route('restaurants.create') }}" class="btn btn-primary mb-3">Ajouter un restaurant</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Type</th>
                <th>Adresse</th>
                <th>Ouvert dimanche midi</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($restaurants as $restaurant)
            <tr>
                <td>{{ $restaurant->nom_restau }}</td>
                <td>{{ $restaurant->type_restau }}</td>
                <td>{{ $restaurant->adresse_postale }}</td>
                <td>{{ $restaurant->ouvert_dimanche_midi ? 'Oui' : 'Non' }}</td>
                <td>
                    <a href="{{ route('restaurants.show', $restaurant) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('restaurants.edit', $restaurant) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('restaurants.destroy', $restaurant) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce restaurant ?')">Supprimer</button>
                    </form>
                    <a href="{{ route('restaurants.avis', $restaurant) }}" class="btn btn-primary btn-sm mt-2">Voir les avis</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="5">Aucun restaurant trouvé.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
