@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des avis</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Copain</th>
                <th>Avis</th>
                <th>Général</th>
                <th>Qualité de la nourriture</th>
                <th>Prix</th>
                <th>Ambiance</th>
            </tr>
        </thead>
        <tbody>
        @forelse($data as $avis)
            <tr>
                <td>{{ $avis->nom }} {{ $avis->prenom }}</td>
                <td>{{ $avis->avis }}</td>
                <td>{{ $avis->overall }}</td>
                <td>{{ $avis->qualite_nourriture }}</td>
                <td>{{ $avis->prix }}</td>
                <td>{{ $avis->ambiance }}</td>
            </tr>
        @empty
            <tr><td colspan="5">Aucun restaurant trouvé.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
