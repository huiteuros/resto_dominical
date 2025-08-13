@extends('layouts.app')

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
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Restaurant</th>
                    <th>Numéro dimanche</th>
                    <th>Date sortie</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($restopasses as $restopasse)
                <tr>
                    <td>{{ $restopasse->id_restopasse }}</td>
                    <td>{{ $restopasse->restaurant->nom_restau ?? '—' }}</td>
                    <td>{{ $restopasse->numero_dimanche ?? '—' }}</td>
                    <td>{{ $restopasse->date_sortie->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('restopasse.show', $restopasse) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('restopasse.edit', $restopasse) }}" class="btn btn-warning btn-sm">Modifier</a>

                        <form action="{{ route('restopasse.destroy', $restopasse) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Supprimer cette sortie ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Supprimer</button>
                        </form>
                        <a href="{{ route('amange.edit', $restopasse) }}" class="btn btn-primary btn-sm">Gérer les présents</a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
