<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
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
     * @var string
     *
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $salt;

    /**
     * @var array
     *
     * @ORM\Column(type="array")
     */
    private $roles;

    /**
     * @var Fiat
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Fiat")
     */
    private $defaultFiat;

    /**
     * @var Asset[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Asset", mappedBy="user")
     */
    private $assets;

    public function __construct()
    {
        $this->salt = md5(uniqid(null, true));
        $this->roles = ['ROLE_USER'];
        $this->assets = new ArrayCollection();
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param $role
     * @return $this
     */
    public function addRole($role)
    {
        $this->roles[] = $role;
        return $this;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param $salt
     * @return $this
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
        return $this;
    }

    /**
     * @return Fiat
     */
    public function getDefaultFiat()
    {
        return $this->defaultFiat;
    }

    /**
     * @param Fiat $defaultFiat
     * @return User
     */
    public function setDefaultFiat(Fiat $defaultFiat)
    {
        $this->defaultFiat = $defaultFiat;
        return $this;
    }

    /**
     * @return Asset[]
     */
    public function getAssets()
    {
        return $this->assets;
    }

    /**
     * @param Asset $asset
     * @return User
     */
    public function addAsset(Asset $asset)
    {
        $this->assets->add($asset);
        return $this;
    }

    /**
     * @param Asset $asset
     * @return User
     */
    public function removeAsset(Asset $asset)
    {
        $this->assets->removeElement($asset);
        return $this;
    }
}
