<?php

namespace AppBundle\Entity;

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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Videos", inversedBy="watchlist")
     * @ORM\JoinTable(name="watchlist_has_videos",
     *   joinColumns={
     *     @ORM\JoinColumn(name="watchlist_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="videos_id", referencedColumnName="id")
     *   }
     * )
     */
    private $videos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->videos = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

