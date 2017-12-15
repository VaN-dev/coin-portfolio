<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssetRepository")
 */
class Asset
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Coin
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Coin")
     */
    private $coin;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Coin
     */
    public function getCoin()
    {
        return $this->coin;
    }

    /**
     * @param Coin $coin
     * @return Asset
     */
    public function setCoin($coin)
    {
        $this->coin = $coin;
        return $this;
    }
}
