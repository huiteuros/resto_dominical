<div class="mb-3">
    <label for="note_general" class="form-label">Note générale (sur 5)</label>
    <input type="number" name="note_general" id="note_general" class="form-control" 
           value="{{ old('note_general', $avis->note_general ?? '') }}" 
           min="0" max="5" step="0.1">
    @error('note_general')
        <div class="text-danger">{{ $message }}</div>
    @enderror
    <small class="form-text text-muted">Laissez vide si vous ne souhaitez pas donner de note</small>
</div>

<div class="mb-3">
    <label for="avis" class="form-label">Votre avis</label>
    <textarea name="avis" id="avis" class="form-control" rows="5">{{ old('avis', $avis->avis ?? '') }}</textarea>
    @error('avis')
        <div class="text-danger">{{ $message }}</div>
    @enderror
    <small class="form-text text-muted">Partagez votre expérience dans ce lieu</small>
</div>

<div class="mb-3 form-check">
    <input type="checkbox" name="reco" id="reco" value="1" class="form-check-input"
           {{ old('reco', $avis->reco ?? false) ? 'checked' : '' }}>
    <label class="form-check-label" for="reco">Je recommande ce lieu</label>
    @error('reco')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
