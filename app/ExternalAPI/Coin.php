<?php

namespace App\ExternalAPI;

use GuzzleHttp\Client;

class Coin
{
    public function __construct()
    {
        $this->client = new Client();
        $this->uri = 'https://api.coinpaprika.com/v1/';

    }

    private function getCertainCoinInfo(string $coinName)
    {
        $coinUri = config('coin.' . strtoupper($coinName));
        if (!$coinUri)
            return false;
        $response = $this->client->request('GET', $this->uri . 'tickers/' . $coinUri . '?quotes=UAH', [
            'Content-Type' => 'application/json'
        ]);
        return $response->getBody();
    }

    public function getCertainCoinPrice(string $coinName)
    {
        $json = json_decode($this->getCertainCoinInfo($coinName));
        return $json->quotes->UAH->price ?? 'smth happened';
    }
}
