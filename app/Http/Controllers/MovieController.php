<?php

namespace App\Http\Controllers;

use Tmdb\Client;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Retrieve the upcoming movies from TMDb.
     *
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
     * Retrive movies from TMDb by query
     */

    public function search(Request $request, Client $tmdb)
    {
        $data = $this->validate($request, [
            'query' => 'required|string'
        ]);
        return $tmdb->getSearchApi()->searchMovies($data['query']);
    }
}
