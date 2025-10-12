@extends('layouts.app')

@section('title', 'Avis - ' . $lieu->nom)

@section('content')
<div class="container">
    <h1 class="h1">Avis pour : {{ $lieu->nom }}</h1>
    
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $lieu->nom }}</h5>
            <p class="card-text">
                <strong>Type :</strong> {{ $lieu->type->nom }}<br>
                <strong>Adresse :</strong> {{ $lieu->adresse ?? 'Non renseignée' }}
            </p>
            @if($avis->count() > 0)
                <p class="card-text">
                    <strong>Note moyenne :</strong> 
                    @if($moyenneNote)
                        {{ number_format($moyenneNote, 1) }}/5 
                        <span class="text-warning">★</span>
                    @else
                        Non noté
                    @endif
                    <br>
                    <strong>Recommandations :</strong> {{ $nbRecommandations }} / {{ $avis->count() }}
                </p>
            @endif
        </div>
    </div>

    <div class="mb-3">
        <a href="{{ route('avis.create', $lieu) }}" class="btn btn-primary">Laisser un avis</a>
        <a href="{{ route('lieux.index') }}" class="btn btn-secondary">Retour aux lieux</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mt-4 mb-3">
        <h3 class="h3 mb-0">Liste des avis ({{ $avis->count() }})</h3>
        
        <!-- Boutons de tri -->
        <div class="btn-group flex-wrap" role="group" aria-label="Trier les avis">
            <a href="{{ route('avis.index', ['lieu' => $lieu, 'sort' => 'recent']) }}" 
               class="btn btn-sm {{ $sortBy == 'recent' ? 'btn-primary' : 'btn-outline-primary' }}"
               title="Trier par date : plus récents en premier">
                📅 Plus récents
            </a>
            <a href="{{ route('avis.index', ['lieu' => $lieu, 'sort' => 'oldest']) }}" 
               class="btn btn-sm {{ $sortBy == 'oldest' ? 'btn-primary' : 'btn-outline-primary' }}"
               title="Trier par date : plus anciens en premier">
                🕒 Plus anciens
            </a>
            <a href="{{ route('avis.index', ['lieu' => $lieu, 'sort' => 'best_rated']) }}" 
               class="btn btn-sm {{ $sortBy == 'best_rated' ? 'btn-primary' : 'btn-outline-primary' }}"
               title="Trier par note : meilleures notes en premier">
                ⭐ Mieux notés
            </a>
            <a href="{{ route('avis.index', ['lieu' => $lieu, 'sort' => 'worst_rated']) }}" 
               class="btn btn-sm {{ $sortBy == 'worst_rated' ? 'btn-primary' : 'btn-outline-primary' }}"
               title="Trier par note : notes les plus basses en premier">
                ⬇️ Moins bien notés
            </a>
        </div>
    </div>

    @forelse($avis as $unAvis)
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title">
                            {{ $unAvis->copain->prenom }} {{ $unAvis->copain->nom }}
                            @if($unAvis->copain->pseudo)
                                ({{ $unAvis->copain->pseudo }})
                            @endif
                        </h5>
                        @if($unAvis->note_general)
                            <p class="mb-1">
                                <strong>Note :</strong> {{ $unAvis->note_general }}/5 
                                <span class="text-warning">★</span>
                            </p>
                        @endif
                        @if($unAvis->reco)
                            <p class="mb-1">
                                <span class="badge bg-success">✓ Recommandé</span>
                            </p>
                        @endif
                        @if($unAvis->avis)
                            <p class="card-text mt-2">{{ $unAvis->avis }}</p>
                        @endif
                        <small class="text-muted">
                            Publié le {{ $unAvis->created_at->format('d/m/Y à H:i') }}
                            @if($unAvis->updated_at != $unAvis->created_at)
                                - Modifié le {{ $unAvis->updated_at->format('d/m/Y à H:i') }}
                            @endif
                        </small>
                    </div>
                    <div>
                        @auth
                            @php
                                $userCopain = \App\Models\Copain::where('user_id', Auth::id())->first();
                            @endphp
                            @if($userCopain && $unAvis->id_copain === $userCopain->id_copain)
                                <a href="{{ route('avis.edit', [$lieu, $unAvis]) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('avis.destroy', [$lieu, $unAvis]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer votre avis ?')">Supprimer</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            Aucun avis pour ce lieu pour le moment. Soyez le premier à en laisser un !
        </div>
    @endforelse
</div>
@endsection
