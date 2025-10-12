@extends('layouts.app')

@section('title', 'Liste des lieux')

@section('content')
<div class="container">
    <h1 class="h1">Liste des lieux</h1>
    <a href="{{ route('lieux.create') }}" class="btn btn-primary mb-3">Ajouter un lieu</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id="lieuxTable" class="table table-bordered table-striped datatable" style="width:100%">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Type</th>
                <th>Adresse</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($lieux as $lieu)
            <tr>
                <td>{{ $lieu->nom }}</td>
                <td>{{ $lieu->type->nom }}</td>
                <td>{{ $lieu->adresse }}</td>
                <td>
                    <div class="d-flex flex-column flex-sm-row gap-1">
                        <a href="{{ route('lieux.show', $lieu) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('lieux.edit', $lieu) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('lieux.destroy', $lieu) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm w-100" onclick="return confirm('Supprimer ce lieu ?')">Supprimer</button>
                        </form>
                        <a href="{{ route('avis.index', $lieu) }}" class="btn btn-primary btn-sm">Avis</a>
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">Aucun lieu trouvé.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
