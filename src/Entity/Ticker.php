<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TickerRepository")
 */
class Ticker
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \DateTimeInterface
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var Coin
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Coin")
     */
    private $coin;

    /**
     * @var Coin
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Fiat")
     */
    private $fiat;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=20, scale=10)
     */
    private $value;


    /**
     * Ticker constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     * @return Ticker
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
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
     * @return Ticker
     */
    public function setCoin($coin)
    {
        $this->coin = $coin;
        return $this;
    }

    /**
     * @return Coin
     */
    public function getFiat()
    {
        return $this->fiat;
    }

    /**
     * @param Coin $fiat
     * @return Ticker
     */
    public function setFiat($fiat)
    {
        $this->fiat = $fiat;
        return $this;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return Ticker
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}
