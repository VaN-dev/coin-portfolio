<?php

namespace App\Service\Coin;

use App\Entity\Coin;
use App\Service\ApiClient\CoinmarketcapClient;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class Importer
 * @package App\Service\Coin
 */
class Importer
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var CoinmarketcapClient
     */
    private $client;

    /**
     * Importer constructor.
     * @param EntityManagerInterface $em
     * @param CoinmarketcapClient $client
     */
    public function __construct(EntityManagerInterface $em, CoinmarketcapClient $client)
    {
        $this->em = $em;
        $this->client = $client;
    }

    /**
     * @return array
     */
    public function import()
    {
        $remoteCoins = $this->client->getCoins();
        $localCoins = array_map(function(Coin $coin) { return ['name' => $coin->getName(), 'symbol' => $coin->getSymbol()]; }, $this->em->getRepository('App:Coin')->findAll());

        $missingCoins = array_filter($remoteCoins, function ($coin) use ($localCoins) {
            return !in_array($coin, $localCoins);
        });

        $coins = [];
        foreach($missingCoins as $missingCoin) {
            $coin = (new Coin())
                ->setName($missingCoin['name'])
                ->setSymbol($missingCoin['symbol'])
            ;
            $this->em->persist($coin);

            $coins[] = $coin;
        }

        return $coins;
    }
}