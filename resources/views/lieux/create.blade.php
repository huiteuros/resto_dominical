@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h1">Ajouter un lieu</h1>

    <form action="{{ route('lieux.store') }}" method="POST">
        @csrf
        @include('lieux.partials.form')
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('lieux.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<!-- Modal pour créer un nouveau type -->
<div class="modal fade" id="createTypeModal" tabindex="-1" aria-labelledby="createTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTypeModalLabel">Créer un nouveau type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="new_type_nom" class="form-label">Nom du type</label>
                    <input type="text" class="form-control" id="new_type_nom" required>
                </div>
                <div id="type-error" class="text-danger d-none"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="saveTypeBtn">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const saveTypeBtn = document.getElementById('saveTypeBtn');
    const newTypeInput = document.getElementById('new_type_nom');
    const typeSelect = document.getElementById('id_type');
    const typeError = document.getElementById('type-error');
    
    saveTypeBtn.addEventListener('click', function() {
        const nom = newTypeInput.value.trim();
        
        if (!nom) {
            typeError.textContent = 'Le nom du type est requis';
            typeError.classList.remove('d-none');
            return;
        }
        
        fetch('{{ route("lieux.storeType") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ nom: nom })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Ajouter le nouveau type à la liste déroulante
                const option = new Option(data.type.nom, data.type.id_type, true, true);
                typeSelect.add(option);
                
                // Fermer le modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('createTypeModal'));
                modal.hide();
                
                // Réinitialiser le formulaire
                newTypeInput.value = '';
                typeError.classList.add('d-none');
            }
        })
        .catch(error => {
            typeError.textContent = 'Erreur lors de la création du type';
            typeError.classList.remove('d-none');
            console.error('Error:', error);
        });
    });
    
    // Réinitialiser l'erreur quand on tape
    newTypeInput.addEventListener('input', function() {
        typeError.classList.add('d-none');
    });
});
</script>
@endpush
@endsection
