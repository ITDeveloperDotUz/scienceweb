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

    public static function getProfileData($user_id)
    {
        $client = new Client();

        $data = $client->get('https://scholarapi.scienceweb.uz/google_scholar?user=' . $user_id, [
            'headers' => ['Accept' => 'application/json']
        ])->getBody();
        return json_decode($data, true);
    }
}
