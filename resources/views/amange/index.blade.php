@extends('layouts.app')

@section('title', 'Mes repas')

@section('content')
<div class="container">
    <h1 class="h1">Mes repas</h1>

    @if($amanges->isEmpty())
        <p>Aucun repas trouvé.</p>
    @else
        <table id="repasTable" class="table table-bordered table-striped datatable" style="width:100%">
            <thead>
                <tr>
                    <th>Restaurant</th>
                    <th>Date</th>
                    <th>Prix</th>
                    <th>Qualité nourriture</th>
                    <th>Ambiance</th>
                    <th>Note globale</th>
                    <th>Avis</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($amanges as $amange)
                    <tr>
                        <td>{{ $amange->restopasse->restaurant->nom_restau }}</td>
                        <td>{{ \Carbon\Carbon::parse($amange->restopasse->date_sortie)->format('d/m/Y') }}</td>
                        <td>{{ $amange->prix ?? 'N/A' }}</td>
                        <td>{{ $amange->qualite_nourriture ?? 'N/A' }}</td>
                        <td>{{ $amange->ambiance ?? 'N/A' }}</td>
                        <td>{{ $amange->overall ?? 'N/A' }}</td>
                        <td class="avis-column">{{ $amange->avis ?? '-' }}</td>
                        <td>
                            <div class="d-flex flex-column flex-sm-row gap-1">
                                <a href="{{ route('amange.show', ['id_copain' => $amange->id_copain, 'id_restopasse' => $amange->id_restopasse]) }}" class="btn btn-info btn-sm">Voir</a>

                                <a href="{{ route('amange.crudedit', ['id_copain' => $amange->id_copain, 'id_restopasse' => $amange->id_restopasse]) }}" class="btn btn-warning btn-sm">Modifier</a>

                                <form action="{{ route('amange.cruddestroy', ['id_copain' => $amange->id_copain, 'id_restopasse' => $amange->id_restopasse]) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Supprimer ce repas ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm w-100" type="submit">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection