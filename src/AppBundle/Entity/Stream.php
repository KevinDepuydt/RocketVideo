<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Stream
 *
 * @ORM\Table(name="stream")
 * @ORM\Entity
 */
class Stream
{
    const STREAM_NOT_DOWNLOADED = 0;
    const STREAM_DOWNLOAD_PROCESSING = 1;
    const STREAM_DOWNLOADED = 2;

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
     * @ORM\Column(name="name", type="text", nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="text", length=65535, nullable=false)
     */
    private $path;

    /**
     * @var int
     *
     * O mean not downloaded
     * 1 mean downloaded
     *
     * @ORM\Column(name="state", type="integer", nullable=false)
     */
    private $state = self::STREAM_NOT_DOWNLOADED;

    /**
     * @var string
     *
     * @ORM\Column(name="public", type="boolean", nullable=false)
     */
    private $public = true;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
     */
    private $user = null;


    public function __construct()
    {
    }

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param int $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return boolean
     */
    public function isPublic()
    {
        return $this->public;
    }

    /**
     * @param boolean $public
     */
    public function setPublic($public)
    {
        $this->public = $public;
    }

    /**
     * @return integer
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

}

