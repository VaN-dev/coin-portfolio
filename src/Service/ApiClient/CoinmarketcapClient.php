<?php

namespace App\Service\ApiClient;

use App\Entity\Coin;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

/**
 * Class CoinmarketcapClient
 * @package App\Service\ApiClient
 */
class CoinmarketcapClient
{
    /**
     * @var string
     */
    protected $base_uri = "https://api.coinmarketcap.com/v1/";

    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $secret;

    /**
     * @var int
     */
    protected $nonce;

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * CoinmarketcapClient constructor.
     */
    public function __construct()
    {
        $this->client = new Client(["base_uri" => $this->base_uri]);
    }

    /**
     * @return array
     */
    public function getTickers()
    {
        $endpoint = "ticker/?convert=EUR&limit=-1";
        $request = $this->client->request("GET", $endpoint);

        $results = json_decode((string) $request->getBody());

        return $results;
    }

    /**
     * @return array
     */
    public function getCoins()
    {
        $results = $this->getTickers();

        $coins = [];

        foreach ($results as $result) {
            $coins[] = [
                "name" => $result->name,
                "symbol" => $result->symbol,
            ];
        }

        return $coins;
    }
}