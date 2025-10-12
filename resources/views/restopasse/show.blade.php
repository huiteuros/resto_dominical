@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1">Détails de la sortie restaurant</h1>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $restopasse->id_restopasse }}</td>
        </tr>
        <tr>
            <th>Restaurant</th>
            <td>
                {{ $restopasse->restaurant->nom_restau ?? '—' }}
                @if($restopasse->numero_dimanche == -1)
                    <span class="badge bg-secondary ms-2">hors-série</span>
                @endif
            </td>
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
