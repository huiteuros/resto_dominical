@extends('layouts.app')

@section('title', 'Liste des Copains')

@section('content')
<div class="container">
    <h1 class="h1">Liste des Copains</h1>
    <a href="{{ route('copains.create') }}" class="btn btn-primary mb-3">Ajouter un copain</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id="copainsTable" class="table table-bordered table-striped datatable">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Pseudo</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($copains as $copain)
                <tr>
                    <td>{{ $copain->nom }}</td>
                    <td>{{ $copain->prenom }}</td>
                    <td>{{ $copain->pseudo }}</td>
                    <td>{{ $copain->user->email ?? '—' }}</td>
                    <td>
                        <div class="d-flex flex-column flex-sm-row gap-1">
                            <a href="{{ route('copains.show', $copain) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('copains.edit', $copain) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('copains.destroy', $copain) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm w-100" onclick="return confirm('Supprimer ce copain ?')">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">Aucun copain trouvé.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection