<?php

namespace App\Providers;

use Tmdb\Client;
use Tmdb\ApiToken;
use Illuminate\Support\ServiceProvider;

class TMDbServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Tmdb\Client', function () {
            $TMDb_KEY = env('TMDb_KEY');
            if (!$TMDb_KEY) {
                throw new \Error("Zzz... Missing TMDb_KEY");
            }
            // Register the client using the key and options from config
            $token = new ApiToken($TMDb_KEY);
            return new Client($token);
        });
    }
}
