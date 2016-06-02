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
     * Owner side
     *
     * @ORM\Column(name="streams", type="array")
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Stream", mappedBy="watchlist", cascade={"persist"})
     */
    private $streams;

    public function __construct()
    {
        $this->streams = new ArrayCollection();
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
     * @param Stream $stream
     * @return $this
     */
    public function addStream(Stream $stream)
    {
        $this->streams->add($stream);

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

