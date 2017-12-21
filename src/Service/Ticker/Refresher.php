<?php

namespace App\Service\Ticker;

use App\Entity\Ticker;
use App\Service\ApiClient\CoinmarketcapClient;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class Refresher
 * @package App\Service\Ticker
 */
class Refresher
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
     * Refresher constructor.
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
    public function refresh()
    {
        $results = $this->client->getTickers();

        $fiats = $this->em->getRepository('App:Fiat')->findAll();
        $dbCoins = $this->em->getRepository('App:Coin')->findAll();

        $coins = [];
        foreach ($dbCoins as $dbCoin){
            $coins[$dbCoin->getSymbol()] = $dbCoin;
        }

        $tickers = [];
        foreach ($results as $result) {
            foreach ($fiats as $fiat) {
                $fiat_property = 'price_'.strtolower($fiat->getSymbol());

                if (null !== $result->$fiat_property && isset($coins[$result->symbol])) {
                    $ticker = (new Ticker())
                        ->setFiat($fiat)
                        ->setCoin($coins[$result->symbol])
                        ->setValue($result->$fiat_property)
                    ;

                    $this->em->persist($ticker);
                    $tickers[] = $ticker;
                }
            }
        }

        return $tickers;
    }
}