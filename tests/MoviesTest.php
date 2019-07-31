<?php

use Tmdb\Client;

class MoviesTest extends TestCase
{
    protected $mockTmdbClient;

    protected $payload;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockTmdbClient = \Mockery::mock(Client::class);
        app()->instance(Client::class, $this->mockTmdbClient);

        $this->payload =
            [
                'results' => [
                    [
                        "title" => "The Lion King",
                        "poster_path" => "/dzBtMocZuJbjLOXvrl4zGYigDzh.jpg",
                        "backdrop_path" => "/1TUg5pO1VZ4B0Q1amk3OlXvlpXV.jpg",
                        "release_date" => "2019-07-25",
                        "genre_ids" => [
                            0 => 18,
                            1 => 35,
                            2 => 28,
                            3 => 80,
                            4 => 37
                        ]
                    ]
                ]
            ];
    }
    /**
     * Should return upcoming movies.
     *
     * @return void
     */
    public function testUpcomingMovies()
    {

        $this->mockTmdbClient->shouldReceive('getMoviesApi->getUpcoming')->andReturn($this->payload);

        $response = $this->get('/movies/upcoming');

        $response->seeStatusCode(200);
        $response->seeJsonEquals($this->payload);
    }

    /**
     * Should return movies based on search
     *
     * @return void
     */
    public function testSearchMovies()
    {
        $this->mockTmdbClient->shouldReceive('getSearchApi->searchMovies')->andReturn($this->payload);

        $response = $this->get('/search/movies?query=The Lion King');

        $response->seeStatusCode(200);
        $response->seeJsonEquals($this->payload);
    }
}
