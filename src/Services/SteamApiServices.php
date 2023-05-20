<?php

namespace App\Services;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class SteamApiServices
{
    private $steamUserApi;
    private $steamApiKey;
    private $client;

    public function __construct($steamUserApi, $steamApiKey, HttpClientInterface $client)
    {
        $this->steamApiKey = $steamApiKey;
        $this->steamUserApi = $steamUserApi;
        $this->client = $client;
    }


    public function GetPlayerSummariesV2(string $steamIds): array
    {
        $response = $this->client->request(
            'GET',
            $this->steamUserApi,
            ["query" => ["key" => $this->steamApiKey, "steamids" => $steamIds]]
        );


        $content = $response->toArray();
        return  $content["response"]["players"][0];
    }
}
