<?php

namespace App\Repository;

use App\Entity\Ticker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class TickerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ticker::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('t')
            ->where('t.something = :value')->setParameter('value', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
