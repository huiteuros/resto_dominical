@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Modifier le repas pour <strong>{{ $amange->getNomRestaurant() }}</strong></h1>

    <form action="{{ route('amange.update', [$amange->id_copain, $amange->id_restopasse]) }}" method="POST" class="needs-validation" novalidate>
        @csrf
        @method('PUT')

        @php
            // Helper pour afficher le nombre d'étoiles sélectionnées
            function starsChecked($field, $value) {
                return old($field, $value) == $value ? 'checked' : '';
            }
        @endphp

        @foreach([
            'prix' => 'Prix',
            'qualite_nourriture' => 'Qualité nourriture',
            'ambiance' => 'Ambiance',
            'overall' => 'Note globale'
        ] as $field => $label)
            <div class="mb-3">
                <label class="form-label">{{ $label }} (1 à 5)</label>
                <div class="star-rating" role="radiogroup" aria-label="{{ $label }}">
                    @for($i=5; $i>=1; $i--)
                        <input type="radio" 
                            id="{{ $field }}-star-{{ $i }}" 
                            name="{{ $field }}" 
                            value="{{ $i }}" 
                            {{ old($field, $amange->$field) == $i ? 'checked' : '' }} 
                            required>
                        <label for="{{ $field }}-star-{{ $i }}" title="{{ $i }} étoile{{ $i > 1 ? 's' : '' }}">
                            &#9733;
                        </label>
                    @endfor
                </div>
                @error($field)
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        @endforeach

        <div class="mb-4">
            <label for="avis" class="form-label">Avis</label>
            <textarea class="form-control @error('avis') is-invalid @enderror" id="avis" name="avis" rows="4" required>{{ old('avis', $amange->avis) }}</textarea>
            @error('avis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success me-2">Enregistrer</button>
        <a href="{{ route('amange.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<style>
.star-rating {
    direction: rtl; /* Affiche les étoiles dans l’ordre visuel correct */
    font-size: 1.8rem;
    unicode-bidi: bidi-override;
    display: inline-flex;
}

.star-rating input[type="radio"] {
    display: none;
}

.star-rating label {
    color: #ddd;
    cursor: pointer;
    user-select: none;
    transition: color 0.2s;
}

.star-rating label:hover,
.star-rating label:hover ~ label,
.star-rating input[type="radio"]:checked ~ label {
    color: #ffc107; /* jaune bootstrap */
}
</style>

<script>
    // Script pour gérer la validation Bootstrap (optionnel)
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>

@endsection
