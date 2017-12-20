<?php

namespace App\DataFixtures;

use App\Entity\Fiat;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class FiatFixtures
 * @package App\DataFixtures
 */
class FiatFixtures extends Fixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $fiat01 = (new Fiat())
            ->setName('US Dollar')
            ->setSymbol('USD')
        ;
        $manager->persist($fiat01);

        $fiat02 = (new Fiat())
            ->setName('Euro')
            ->setSymbol('EUR')
        ;
        $manager->persist($fiat02);

        $manager->flush();

        $this->addReference('fiat-01', $fiat01);
        $this->addReference('fiat-01', $fiat02);
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 10;
    }
}