@extends('layouts.app')

@section('title', 'Mes avis sur les lieux')

@section('content')
<div class="container">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <h1 class="h1 mb-0">Mes avis sur les lieux</h1>
        
        <!-- Boutons de tri -->
        @if($avis->count() > 0)
            <div class="btn-group flex-wrap" role="group" aria-label="Trier mes avis">
                <a href="{{ route('avis.mes-avis', ['sort' => 'recent']) }}" 
                   class="btn btn-sm {{ $sortBy == 'recent' ? 'btn-primary' : 'btn-outline-primary' }}"
                   title="Trier par date : plus récents en premier">
                    📅 Plus récents
                </a>
                <a href="{{ route('avis.mes-avis', ['sort' => 'oldest']) }}" 
                   class="btn btn-sm {{ $sortBy == 'oldest' ? 'btn-primary' : 'btn-outline-primary' }}"
                   title="Trier par date : plus anciens en premier">
                    🕒 Plus anciens
                </a>
                <a href="{{ route('avis.mes-avis', ['sort' => 'best_rated']) }}" 
                   class="btn btn-sm {{ $sortBy == 'best_rated' ? 'btn-primary' : 'btn-outline-primary' }}"
                   title="Trier par note : meilleures notes en premier">
                    ⭐ Mieux notés
                </a>
                <a href="{{ route('avis.mes-avis', ['sort' => 'worst_rated']) }}" 
                   class="btn btn-sm {{ $sortBy == 'worst_rated' ? 'btn-primary' : 'btn-outline-primary' }}"
                   title="Trier par note : notes les plus basses en premier">
                    ⬇️ Moins bien notés
                </a>
            </div>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @forelse($avis as $monAvis)
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1">
                        <h5 class="card-title">{{ $monAvis->lieu->nom }}</h5>
                        <p class="mb-1">
                            <strong>Type :</strong> {{ $monAvis->lieu->type->nom }}
                        </p>
                        @if($monAvis->lieu->adresse)
                            <p class="mb-1">
                                <strong>Adresse :</strong> {{ $monAvis->lieu->adresse }}
                            </p>
                        @endif
                        @if($monAvis->note_general)
                            <p class="mb-1">
                                <strong>Ma note :</strong> {{ $monAvis->note_general }}/5 
                                <span class="text-warning">★</span>
                            </p>
                        @endif
                        @if($monAvis->reco)
                            <p class="mb-1">
                                <span class="badge bg-success">✓ Recommandé</span>
                            </p>
                        @endif
                        @if($monAvis->avis)
                            <p class="card-text mt-2">{{ $monAvis->avis }}</p>
                        @endif
                        <small class="text-muted">
                            Publié le {{ $monAvis->created_at->format('d/m/Y à H:i') }}
                            @if($monAvis->updated_at != $monAvis->created_at)
                                - Modifié le {{ $monAvis->updated_at->format('d/m/Y à H:i') }}
                            @endif
                        </small>
                    </div>
                    <div class="ms-3">
                        <a href="{{ route('avis.index', $monAvis->lieu) }}" class="btn btn-info btn-sm">Voir tous les avis</a>
                        <a href="{{ route('avis.edit', [$monAvis->lieu, $monAvis]) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('avis.destroy', [$monAvis->lieu, $monAvis]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet avis ?')">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            Vous n'avez pas encore laissé d'avis sur des lieux. 
            <a href="{{ route('lieux.index') }}">Consultez la liste des lieux</a> pour commencer !
        </div>
    @endforelse
</div>
@endsection
