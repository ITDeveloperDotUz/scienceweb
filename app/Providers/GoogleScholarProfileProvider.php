<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

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

        $data = $client->get('https://scholarapi.scienceweb.uz/profile?' . $url, [
            'headers' => ['Accept' => 'application/vnd.orcid+json']
        ])->getBody();
        return json_decode($data, true);
    }
}
