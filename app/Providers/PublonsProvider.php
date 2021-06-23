<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use phpDocumentor\Reflection\Types\False_;

class PublonsProvider extends ServiceProvider
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
        if (preg_match("/\w{4}-\w{4}-\w{4}-\w{4}/", $link)){
            $id = $str->match('/\w{4}-\w{4}-\w{4}-\w{4}/');
        } elseif (preg_match("/researcher\/(\d+)/", $link)){
            $id = $str->match("/researcher\/(\d+)/");
        } elseif (preg_match("/[A-Z]{1,3}-\d{4}-\d{4}/", $link)) {
            $id = $str->match('/[A-Z]{1,3}-\d{4}-\d{4}/');
        } else {
            return false;
        }

        $client = new Client();
        $data = $client->get('https://scholarapi.scienceweb.uz/publons?user=' . $id, [
            'headers' => ['Accept' => 'application/json']
        ])->getBody();
        return json_decode($data, true);
    }

}
