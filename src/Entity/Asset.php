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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="assets")
     */
    private $user;

    /**
     * @var Coin
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Coin")
     */
    private $coin;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=20, scale=10)
     */
    private $holdings;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Asset
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
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

    /**
     * @return float
     */
    public function getHoldings()
    {
        return $this->holdings;
    }

    /**
     * @param float $holdings
     * @return Asset
     */
    public function setHoldings($holdings)
    {
        $this->holdings = $holdings;
        return $this;
    }
}
