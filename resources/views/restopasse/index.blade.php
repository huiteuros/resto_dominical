@extends('layouts.app')

@section('title', 'Liste des sorties restaurant')

@section('content')
<div class="container">
    <h1 class="h1">Liste des sorties restaurant</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('restopasse.create') }}" class="btn btn-primary mb-3">Ajouter une sortie</a>

    @if($restopasses->isEmpty())
        <p>Aucune sortie enregistrée.</p>
    @else
        <table id="restopasseTable" class="table table-bordered table-striped datatable" style="width:100%">
            <thead>
                <tr>
                    <th>Date sortie</th>
                    <th>Restaurant</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($restopasses as $restopasse)
                <tr>
                    <td>{{ $restopasse->date_sortie->format('d/m/Y') }}</td>
                    <td>
                        {{ $restopasse->restaurant->nom_restau ?? '—' }}
                        @if($restopasse->numero_dimanche == -1)
                            <span class="badge bg-secondary ms-2">hors-série</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex flex-column flex-sm-row gap-1">
                            <a href="{{ route('restopasse.show', $restopasse) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('restopasse.edit', $restopasse) }}" class="btn btn-warning btn-sm">Modifier</a>

                            <form action="{{ route('restopasse.destroy', $restopasse) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette sortie ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm w-100" type="submit">Supprimer</button>
                            </form>

                            <a href="{{ route('amange.edit', $restopasse) }}" class="btn btn-primary btn-sm">Gérer les présents</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
