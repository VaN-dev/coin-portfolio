<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Coin;

/**
 * Class CoinFixtures
 * @package App\DataFixtures
 */
class CoinFixtures extends Fixture  implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $coin01 = (new Coin())
            ->setName('Bitcoin')
            ->setSymbol('BTC')
        ;
        $manager->persist($coin01);

        $coin02 = (new Coin())
            ->setName('Ripple')
            ->setSymbol('XRP')
        ;
        $manager->persist($coin02);

        $coin03 = (new Coin())
            ->setName('Ethereum')
            ->setSymbol('ETH')
        ;
        $manager->persist($coin03);

        $coin04 = (new Coin())
            ->setName('Litecoin')
            ->setSymbol('LTC')
        ;
        $manager->persist($coin04);

        $coin05 = (new Coin())
            ->setName('Bitcoin Cash')
            ->setSymbol('BCH')
        ;
        $manager->persist($coin05);

        $coin06 = (new Coin())
            ->setName('Monetha')
            ->setSymbol('MTH')
        ;
        $manager->persist($coin06);

        $coin07 = (new Coin())
            ->setName('Stellar')
            ->setSymbol('XLM')
        ;
        $manager->persist($coin07);

        $manager->flush();

        $this->addReference('coin-bitcoin', $coin01);
        $this->addReference('coin-ripple', $coin02);
        $this->addReference('coin-ethereum', $coin03);
        $this->addReference('coin-litecoin', $coin04);
        $this->addReference('coin-bitcoincash', $coin05);
        $this->addReference('coin-monetha', $coin06);
        $this->addReference('coin-stellar', $coin07);
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }
}