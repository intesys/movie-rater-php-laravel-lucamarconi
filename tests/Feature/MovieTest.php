<?php

use App\Models\Movie;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MovieTest extends TestCase
{

    use RefreshDatabase;

    /***
     * Test per verificare che i risultati della ricerca siano coerenti con i filtri inseriti
     * @return void
     */
    public function test_movies_index_multiple_filters()
    {
        // Film valido: corrisponde a entrambi i filtri (Titolo e Genere)
        Movie::factory()->create([
            'title' => 'Inception',
            'genre' => 'Sci-Fi',
            'director' => 'Christopher Nolan'
        ]);

        // Film con stesso titolo ma genere diverso (non deve essere restituito)
        Movie::factory()->create([
            'title' => 'Inception',
            'genre' => 'Drama',
            'director' => 'Fake Director'
        ]);

        Movie::factory()->create(['title' => 'Avatar', 'genre' => 'Sci-Fi']);
        Movie::factory()->create(['title' => 'The Godfather', 'genre' => 'Drama']);

        $response = $this->get('/movies?search=Inception&genre=Sci-Fi');

        $response->assertStatus(200);
        $response->assertSee('Christopher Nolan');
        $response->assertDontSee('Fake Director');
        $response->assertDontSee('Avatar');
        $response->assertDontSee('The Godfather');
    }

    /**
     * Test per valutare che il command elimini i film più vecchi di 5 anni rispetto all'anno corrente
     * @return void
     */
    public function test_delete_movies_artisan_command_purges_database()
    {
        $oldMovie = Movie::factory()->create(['release_year' => 2010]);
        $newMovie = Movie::factory()->create(['release_year' => 2025]);

        $this->artisan('movies:delete --years=5')
            ->expectsOutputToContain('eliminati')
            ->assertExitCode(0);

        // ci aspettiamo 1 solo film e che il suo id corrisponda a quello di $newMovie(2025)
        $this->assertDatabaseCount('movies', 1);
        $this->assertDatabaseMissing('movies', ['id' => $oldMovie->id]);
        $this->assertDatabaseHas('movies', ['id' => $newMovie->id]);
    }

    public function test_movie_creation_requires_fields()
    {
        // 1. Tentiamo di inviare un payload vuoto alla rotta di creazione
        $response = $this->post('/movies', []);
        // ci aspettiamo un redirect con gli errori di validazione
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['title', 'release_year', 'director', 'genre', 'cast', 'plot']);
        // ci aspettiamo che la count dei film a db sia 0
        $this->assertDatabaseCount('movies', 0);
    }
}


