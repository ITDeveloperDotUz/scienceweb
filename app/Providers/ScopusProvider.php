<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class ScopusProvider extends ServiceProvider
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

    public static function getProfileData($link)
    {
        $str = Str::of($link);
        $id = $str->match('/authorId=(\d+)/');
        $client = new Client();
        $data = $client->get('https://scholarapi.scienceweb.uz/scopus?user=' . $id, [
            'headers' => ['Accept' => 'application/json']
        ])->getBody();
        return json_decode($data, true);
    }
}
