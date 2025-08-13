@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1">Gérer les présents pour : {{ $restopasse->restaurant->nom_restau }} - {{ $restopasse->date_sortie->format('d/m/Y') }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h3>Copains présents</h3>
    <ul>
        @forelse($presentCopains as $copain)
            <li>
                {{ $copain->prenom }} {{ $copain->nom }} ({{ $copain->pseudo }})
                <form action="{{ route('amange.destroy', [$restopasse, $copain]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Retirer ce copain ?')" class="btn btn-danger btn-sm">Retirer</button>
                </form>
            </li>
        @empty
            <li>Aucun copain présent.</li>
        @endforelse
    </ul>

    <h3>Ajouter un copain</h3>
    <form action="{{ route('amange.store', $restopasse) }}" method="POST">
        @csrf
        <select name="id_copain" required>
            <option value="">-- Choisir un copain --</option>
            @foreach($allCopains as $copain)
                @if(!$presentCopains->contains($copain))
                    <option value="{{ $copain->id_copain }}">
                        {{ $copain->prenom }} {{ $copain->nom }} ({{ $copain->pseudo }})
                    </option>
                @endif
            @endforeach
        </select>
        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>
</div>
@endsection
