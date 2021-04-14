<?php


namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;


 class ORCIDProvider extends ServiceProvider
{

    public static function getAccessToken()
    {
        return redirect('https://orcid.org/oauth/authorize?client_id='.config('services.orcid.client_id').'&response_type=code&scope=/authenticate&redirect_uri='.config('services.orcid.redirect'));
    }
    public static function getUserToken($code)
    {
         $client = new Client();
         $data = $client->post('https://orcid.org/oauth/token', [
             'headers' => ['Accept' => 'application/json'],
             'form_params' => [
                 'client_id' => config('services.orcid.client_id'),
                 'client_secret' => config('services.orcid.client_secret'),
                 'grant_type' => 'authorization_code',
                 'code' => $code,
                 'redirect_uri' => config('services.orcid.redirect')
             ]
         ])->getBody();
         return json_decode($data, true);
    }
    public static function getClientCredentials()
    {
        $client = new Client();
        $data = $client->post('https://orcid.org/oauth/token', [
            'headers' => ['Accept' => 'application/json'],
            'form_params' => [
                'client_id' => config('services.orcid.client_id'),
                'client_secret' => config('services.orcid.client_secret'),
                'grant_type' => 'client_credentials',
                'scope' => '/read-public',
            ]
        ])->getBody();
        return json_decode($data, true);
    }


    public static function getPersonalDetails($tokens)
    {
        $client = new Client();
        $data = $client->get('https://pub.orcid.org/v3.0/'.$tokens['orcid'].'', [
            'headers' => ['Accept' => 'application/vnd.orcid+json', 'Authorization'=>'Bearer '.$tokens['access_token']],
        ])->getBody();
        return json_decode($data, true);
    }
}
