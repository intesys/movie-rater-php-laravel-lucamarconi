@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Lista Film</h2>
        <a href="{{ route('movies.create') }}" class="btn btn-primary">Aggiungi Film</a>
    </div>

    {{-- Form Filtri --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body bg-light">
            <form action="{{ route('movies.index') }}" method="GET" class="row g-3 align-items-end">

                <div class="col-md-4">
                    <label for="search" class="form-label text-muted small fw-bold">Cerca (Titolo o Regista)</label>
                    <input type="text" class="form-control" id="search" name="search"
                           value="{{ request('search') }}" placeholder="Es. Nolan, Matrix...">
                </div>

                <div class="col-md-3">
                    <label for="genre" class="form-label text-muted small fw-bold">Genere</label>
                    <input type="text" class="form-control" id="genre" name="genre"
                           value="{{ request('genre') }}" placeholder="Es. Sci-Fi">
                </div>

                <div class="col-md-2">
                    <label for="year" class="form-label text-muted small fw-bold">Anno</label>
                    <input type="number" class="form-control" id="year" name="year"
                           value="{{ request('year') }}" placeholder="Es. 2023">
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">Filtra</button>
                    @if(request()->anyFilled(['search', 'genre', 'year']))
                        <a href="{{ route('movies.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                <tr>
                    <th>Titolo</th>
                    <th>Anno</th>
                    <th>Regista</th>
                    <th>Genere</th>
                    <th class="text-end">Azioni</th>
                </tr>
                </thead>
                <tbody>
                @forelse($movies as $movie)
                    <tr>
                        <td class="align-middle fw-bold">{{ $movie->title }}</td>
                        <td class="align-middle">{{ $movie->release_year }}</td>
                        <td class="align-middle">{{ $movie->director }}</td>
                        <td class="align-middle">
                            <span class="badge bg-secondary">{{ $movie->genre }}</span>
                        </td>
                        <td class="text-end align-middle">
                            {{-- show --}}
                            <a href="{{ route('movies.show', $movie) }}" class="btn btn-sm btn-info text-white" title="Dettagli">
                                <i class="bi bi-eye"></i>
                            </a>
                            {{-- edit --}}
                            <a href="{{ route('movies.edit', $movie) }}" class="btn btn-sm btn-warning text-white" title="Modifica">
                                <i class="bi bi-pencil"></i>
                            </a>
                            {{-- destroy--}}
                            <form action="{{ route('movies.destroy', $movie) }}" method="POST" class="d-inline" onsubmit="return confirm('Sei sicuro di voler eliminare questo film?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Elimina">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">Nessun film trovato nel database.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{-- Mostra i link della paginazione --}}
        {{ $movies->links() }}
    </div>
@endsection
