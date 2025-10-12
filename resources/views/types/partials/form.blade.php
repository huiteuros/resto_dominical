<div class="mb-3">
    <label for="nom" class="form-label">Nom du type</label>
    <input type="text" name="nom" id="nom" class="form-control" 
           value="{{ old('nom', $type->nom ?? '') }}" required>
    @error('nom')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
