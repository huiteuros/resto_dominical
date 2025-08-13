@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails de la sortie restaurant</h1>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $restopasse->id_restopasse }}</td>
        </tr>
        <tr>
            <th>Restaurant</th>
            <td>{{ $restopasse->restaurant->nom_restau ?? '—' }}</td>
        </tr>
        <tr>
            <th>Numéro dimanche</th>
            <td>{{ $restopasse->numero_dimanche ?? '—' }}</td>
        </tr>
        <tr>
            <th>Date sortie</th>
            <td>{{ $restopasse->date_sortie->format('d/m/Y') }}</td>
        </tr>
    </table>

    <a href="{{ route('restopasse.index') }}" class="btn btn-secondary">Retour à la liste</a>
    <a href="{{ route('restopasse.edit', $restopasse) }}" class="btn btn-warning">Modifier</a>
</div>
@endsection
