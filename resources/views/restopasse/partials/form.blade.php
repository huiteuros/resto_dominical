<form method="POST" action="{{ isset($restopasse) ? route('restopasse.update', $restopasse) : route('restopasse.store') }}">
    @csrf
    @if(isset($restopasse))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="id_restaurant" class="form-label">Restaurant</label>
        <select name="id_restaurant" id="id_restaurant" class="form-select" required>
            <option value="">-- Choisir un restaurant --</option>
            @foreach ($restaurants as $restaurant)
                <option value="{{ $restaurant->id_restaurant }}"
                    {{ (old('id_restaurant', $restopasse->id_restaurant ?? '') == $restaurant->id_restaurant) ? 'selected' : '' }}>
                    {{ $restaurant->nom_restau }}
                </option>
            @endforeach
        </select>
        @error('id_restaurant')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Type de sortie</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="serie_dimanche" id="serie_dimanche_oui" value="1" 
                {{ old('serie_dimanche', (isset($restopasse) && $restopasse->numero_dimanche >= 0) ? '1' : '0') == '1' ? 'checked' : '' }}>
            <label class="form-check-label" for="serie_dimanche_oui">
                Série du dimanche
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="serie_dimanche" id="serie_dimanche_non" value="0" 
                {{ old('serie_dimanche', (isset($restopasse) && $restopasse->numero_dimanche >= 0) ? '1' : '0') == '0' ? 'checked' : '' }}>
            <label class="form-check-label" for="serie_dimanche_non">
                Hors série
            </label>
        </div>
        @error('serie_dimanche')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="date_sortie" class="form-label">Date sortie</label>
        <input type="date" name="date_sortie" id="date_sortie" class="form-control" value="{{ old('date_sortie', isset($restopasse) ? $restopasse->date_sortie->format('Y-m-d') : '') }}" required>
        @error('date_sortie')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($restopasse) ? 'Mettre à jour' : 'Créer' }}</button>
</form>
