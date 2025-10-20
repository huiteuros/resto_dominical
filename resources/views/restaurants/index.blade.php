@extends('layouts.app')

@section('title', 'Liste des restaurants')

@section('content')
<div class="container">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <h1 class="h1 mb-0">Liste des restaurants</h1>
        
        <!-- Boutons de filtre -->
        <div class="btn-group flex-wrap" role="group" aria-label="Filtrer les restaurants">
            <a href="{{ route('restaurants.index', ['filter' => 'all']) }}" 
               class="btn btn-sm {{ (!isset($filter) || $filter == 'all') ? 'btn-primary' : 'btn-outline-primary' }}">
                📋 Tous les restaurants
            </a>
            <a href="{{ route('restaurants.index', ['filter' => 'sans_sortie']) }}" 
               class="btn btn-sm {{ (isset($filter) && $filter == 'sans_sortie') ? 'btn-primary' : 'btn-outline-primary' }}">
                🔍 Sans sortie
            </a>
        </div>
    </div>
    
    <a href="{{ route('restaurants.create') }}" class="btn btn-primary mb-3">Ajouter un restaurant</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id="restaurantsTable" class="table table-bordered table-striped datatable" style="width:100%">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Type</th>
                <th>Ouvert dimanche midi</th>
                <th>Adresse</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($restaurants as $restaurant)
            <tr>
                <td>
                    {{ $restaurant->nom_restau }}
                    @if($restaurant->restopasses_count == 0)
                        <span class="badge bg-info text-dark ms-2">Sans sortie</span>
                    @endif
                </td>
                <td>{{ $restaurant->type_restau }}</td>
                <td>{{ $restaurant->ouvert_dimanche_midi ? 'Oui' : 'Non' }}</td>
                <td>{{ $restaurant->adresse_postale }}</td> 
                <td>
                    <div class="d-flex flex-column flex-sm-row gap-1">
                        <a href="{{ route('restaurants.show', $restaurant) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('restaurants.edit', $restaurant) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('restaurants.destroy', $restaurant) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm w-100" onclick="return confirm('Supprimer ce restaurant ?')">Supprimer</button>
                        </form>
                        @if($restaurant->restopasses_count > 0)
                            <a href="{{ route('restaurants.avis', $restaurant) }}" class="btn btn-primary btn-sm">Avis</a>
                        @endif
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