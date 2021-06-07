<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

class GoogleScholarProfileProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public static function getProfileData($url)
    {
        $client = new Client();
        $user = Str::of($url)->match('/user=[A-Za-z0-9_-]+/');

        $data = $client->get('https://scholarapi.scienceweb.uz/google_scholar?' . $user, [
            'headers' => ['Accept' => 'application/json']
        ])->getBody();
        return json_decode($data, true);
    }
}
