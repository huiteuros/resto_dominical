<div class="mb-3">
    <label for="nom_restau" class="form-label">Nom</label>
    <input type="text" name="nom_restau" id="nom_restau" class="form-control" 
           value="{{ old('nom_restau', $restaurant->nom_restau ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="type_restau" class="form-label">Type</label>
    <input type="text" name="type_restau" id="type_restau" class="form-control" 
           value="{{ old('type_restau', $restaurant->type_restau ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="adresse_postale" class="form-label">Adresse</label>
    <input type="text" name="adresse_postale" id="adresse_postale" class="form-control" 
           value="{{ old('adresse_postale', $restaurant->adresse_postale ?? '') }}">
</div>

<div class="mb-3">
    <label for="lien_site_web" class="form-label">Lien site web</label>
    <input type="url" name="lien_site_web" id="lien_site_web" class="form-control" 
           value="{{ old('lien_site_web', $restaurant->lien_site_web ?? '') }}">
</div>

<div class="mb-3 form-check">
    <input type="checkbox" name="ouvert_dimanche_midi" id="ouvert_dimanche_midi" value="1" class="form-check-input"
           {{ old('ouvert_dimanche_midi', $restaurant->ouvert_dimanche_midi ?? false) ? 'checked' : '' }}>
    <label class="form-check-label" for="ouvert_dimanche_midi">Ouvert dimanche midi</label>
</div>
