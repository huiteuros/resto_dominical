@extends('layouts.app')

@section('title', 'Liste des restaurants')

@section('content')
<div class="container">
    <h1 class="h1">Liste des restaurants</h1>
    <a href="{{ route('restaurants.create') }}" class="btn btn-primary mb-3">Ajouter un restaurant</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id="restaurantsTable" class="table table-bordered table-striped datatable" style="width:100%">
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
                    <div class="d-flex flex-column flex-sm-row gap-1">
                        <a href="{{ route('restaurants.show', $restaurant) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('restaurants.edit', $restaurant) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('restaurants.destroy', $restaurant) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm w-100" onclick="return confirm('Supprimer ce restaurant ?')">Supprimer</button>
                        </form>
                        <a href="{{ route('restaurants.avis', $restaurant) }}" class="btn btn-primary btn-sm">Voir les avis</a>
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="5">Aucun restaurant trouvé.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection