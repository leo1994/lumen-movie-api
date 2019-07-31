<?php

namespace App\Http\Controllers;

use Tmdb\Client;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Retrieve the upcoming movies from TMDb.
     *
     * @param Request $request
     * @param Client $tmdb
     * @return Response
     */
    public function upcoming(Request $request, Client $tmdb)
    {
        $data = $this->validate($request, [
            'page' => 'sometimes|required|int'
        ]);
        $page = $data['page'] ?? 1;
        return $tmdb->getMoviesApi()->getUpcoming(['page' => $page]);
    }

    /**
     * Search movies from TMDb by query
     *
     * @param Request $request
     * @param Client $tmdb
     * @return void
     */
    public function search(Request $request, Client $tmdb)
    {
        $data = $this->validate($request, [
            'query' => 'required|string',
            'page' => 'sometimes|required|int'
        ]);

        $page = $data['page'] ?? 1;
        return $tmdb->getSearchApi()->searchMovies($data['query'], ['page' => $page]);
    }
}
