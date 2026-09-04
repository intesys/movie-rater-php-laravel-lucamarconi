<div class="row">
    <div class="col-md-8 mb-3">
        <label for="title" class="form-label">Titolo</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
               value="{{ old('title', $movie->title ?? '') }}" required>
        @error('title')
        <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label for="release_year" class="form-label">Anno di Uscita</label>
        <input type="number" class="form-control @error('release_year') is-invalid @enderror" id="release_year"
               name="release_year" value="{{ old('release_year', $movie->release_year ?? '') }}" required>
        @error('release_year')
        <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="director" class="form-label">Regista</label>
        <input type="text" class="form-control @error('director') is-invalid @enderror" id="director" name="director"
               value="{{ old('director', $movie->director ?? '') }}" required>
        @error('director')
        <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="genre" class="form-label">Genere</label>
        <input type="text" class="form-control @error('genre') is-invalid @enderror" id="genre" name="genre"
               value="{{ old('genre', $movie->genre ?? '') }}" required>
        @error('genre')
        <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="mb-4">
    <label class="form-label">Cast</label>
    @error('cast')
        <div class="invalid-feedback d-block mb-2">{{ $message }}</div>
    @enderror
    <div id="cast-container">
        @php
            $currentCast = old('cast', $movie->cast ?? []);
            if (empty($currentCast)) {
                $currentCast = [''];
            }
        @endphp
        {{-- Usiamo l'array vuoto come fallback se il film è nuovo --}}
        @foreach(old('cast', $movie->cast ?? []) as $index => $actor)
            <div class="input-group mb-2 cast-row">
                <input type="text" name="cast[]" class="form-control @error("cast.$index") is-invalid @enderror"
                       value="{{ $actor }}" required>
                <button class="btn btn-outline-danger" type="button" onclick="this.parentElement.remove()">Rimuovi
                </button>
                @error("cast.$index")
                <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        @endforeach
    </div>
    <button type="button" id="add-actor" class="btn btn-sm btn-secondary mt-1">+ Aggiungi Attore</button>
</div>

<div class="mb-4">
    <label for="plot" class="form-label">Trama</label>
    <textarea class="form-control @error('plot') is-invalid @enderror" id="plot" name="plot" rows="4"
              required>{{ old('plot', $movie->plot ?? '') }}</textarea>
    @error('plot')
    <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

{{-- Passiamo il testo del bottone come variabile dalla vista genitore --}}
<button type="submit" class="btn btn-success px-4">{{ $submitButtonText ?? 'Salva' }}</button>

<script>
    // Se lo script esiste già non lo duplichiamo (utile se carichi la vista via ajax, ma in generale è sicuro)
    if (!document.getElementById('add-actor').hasAttribute('data-initialized')) {
        document.getElementById('add-actor').setAttribute('data-initialized', 'true');
        document.getElementById('add-actor').addEventListener('click', function () {
            const container = document.getElementById('cast-container');
            const html = `
                <div class="input-group mb-2 cast-row">
                    <input type="text" name="cast[]" class="form-control" placeholder="Nome attore" required>
                    <button class="btn btn-outline-danger" type="button" onclick="this.parentElement.remove()">Rimuovi</button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        });
    }
</script>
