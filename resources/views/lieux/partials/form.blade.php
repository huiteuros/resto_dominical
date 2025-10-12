<div class="mb-3">
    <label for="nom" class="form-label">Nom du lieu</label>
    <input type="text" name="nom" id="nom" class="form-control" 
           value="{{ old('nom', $lieu->nom ?? '') }}" required>
    @error('nom')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="adresse" class="form-label">Adresse</label>
    <input type="text" name="adresse" id="adresse" class="form-control" 
           value="{{ old('adresse', $lieu->adresse ?? '') }}">
    @error('adresse')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="id_type" class="form-label">Type</label>
    <div class="d-flex gap-2">
        <select name="id_type" id="id_type" class="form-control" required>
            <option value="">-- Choisir un type --</option>
            @foreach($types as $type)
                <option value="{{ $type->id_type }}" 
                    {{ old('id_type', $lieu->id_type ?? '') == $type->id_type ? 'selected' : '' }}>
                    {{ $type->nom }}
                </option>
            @endforeach
        </select>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTypeModal">
            <i class="bi bi-plus"></i> Nouveau
        </button>
    </div>
    @error('id_type')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
