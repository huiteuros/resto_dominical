@extends('layouts.app')

@section('title', 'Liste des types')

@section('content')
<div class="container">
    <h1 class="h1">Liste des types de lieu</h1>
    <a href="{{ route('types.create') }}" class="btn btn-primary mb-3">Ajouter un type</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id="typesTable" class="table table-bordered table-striped datatable" style="width:100%">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($types as $type)
            <tr>
                <td>{{ $type->nom }}</td>
                <td>
                    <div class="d-flex flex-column flex-sm-row gap-1">
                        <a href="{{ route('types.show', $type) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('types.edit', $type) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('types.destroy', $type) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm w-100" onclick="return confirm('Supprimer ce type ?')">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="2">Aucun type trouvé.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
