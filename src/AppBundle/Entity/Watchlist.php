<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Watchlist
 *
 * @ORM\Table(name="watchlist")
 * @ORM\Entity
 */
class Watchlist
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
     * @var array
     *
     * @ORM\Column(name="streams", type="array")
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Stream", cascade={"persist"})
     */
    private $streams;
    

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
     * @param Stream $stream
     * @return $this
     */
    public function addStream(Stream $stream)
    {
        $this->streams[] = $stream;

        return $this;
    }

    /**
     * @param Stream $stream
     */
    public function removeStream(Stream $stream)
    {
        $this->streams->removeElement($stream);
    }

    /**
     * @return ArrayCollection
     */
    public function getStreams()
    {
        return $this->streams;
    }

}

