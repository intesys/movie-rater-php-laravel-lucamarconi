@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Dettaglio Film</h5>
                <a href="{{ route('movies.index') }}" class="btn btn-sm btn-light">Torna alla lista</a>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Titolo</label>
                        <input type="text" class="form-control bg-light" value="{{ $movie->title }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Anno di Uscita</label>
                        <input type="number" class="form-control bg-light" value="{{ $movie->release_year }}" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Regista</label>
                        <input type="text" class="form-control bg-light" value="{{ $movie->director }}" readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Genere</label>
                        <input type="text" class="form-control bg-light" value="{{ $movie->genre }}" readonly>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Cast</label>
                    <div id="cast-container">
                        @forelse($movie->cast ?? [] as $actor)
                            <div class="input-group mb-2">
                                <input type="text" class="form-control bg-light" value="{{ $actor }}" readonly>
                            </div>
                        @empty
                            <input type="text" class="form-control bg-light text-muted" value="Nessun attore registrato" readonly>
                        @endforelse
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Trama</label>
                    <textarea class="form-control bg-light" rows="4" readonly>{{ $movie->plot }}</textarea>
                </div>

            </div>

            <div class="card-footer bg-light d-flex gap-2">
                <a href="{{ route('movies.edit', $movie) }}" class="btn btn-warning text-dark">Modifica</a>
                <form action="{{ route('movies.destroy', $movie) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questo film?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Elimina</button>
                </form>
            </div>
        </div>
    </div>
@endsection
