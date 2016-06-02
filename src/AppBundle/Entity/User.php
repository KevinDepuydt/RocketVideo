<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 * @UniqueEntity("email", message="Cet e-mail est déjà pris")
 * @UniqueEntity("username", message="Ce nom d'utilisateur est déjà pris")
 */
class User implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=150, nullable=false, unique=true)
     * @Assert\Email(
     *     message = "L'email {{ value }} n'est pas valide",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=130, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=45, nullable=false)
     * @Assert\Length(min=3, minMessage = "Le nom d'utilisateur est trop court")
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=false, unique=true)
     */
    private $salt;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array", nullable=false)
     */
    private $roles;

    /**
     * @var \AppBundle\Entity\Watchlist
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Watchlist",  cascade={"persist"})
     */
    private $watchlist;
    

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
     */
    public function setPassword($password)
    {
        $this->password = $password;
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
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }


    public function setWatchlist(Watchlist $watchlist)
    {
        $this->watchlist = $watchlist;
    }

    public function getWatchlist()
    {
        return $this->watchlist;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}

