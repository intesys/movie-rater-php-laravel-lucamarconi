<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Models\Movie;
use App\Services\MovieService;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function __construct(
        protected MovieService $movieService
    ) {}

    public function index()
    {
        $movies = Movie::query()
            ->filter(request(['search', 'genre', 'year'])) // scopeFilter
            ->alphabetical() // scopeAlphabetical
            ->paginate(10)
            ->withQueryString();

        return view('movies.index', compact('movies'));
    }

    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    public function store(MovieRequest $request)
    {
        $this->movieService->createMovie($request->validated());
        return redirect()->route('movies.index')->with('success', 'Film inserito con successo!');
    }

    public function update(MovieRequest $request, Movie $movie)
    {
        $this->movieService->updateMovie($movie, $request->validated());
        return redirect()->route('movies.index')->with('success', 'Film aggiornato con successo!');
    }

    public function destroy(Movie $movie)
    {
        $this->movieService->deleteMovie($movie);

        return redirect()->route('movies.index')->with('success', 'Film eliminato con successo!');
    }
}
