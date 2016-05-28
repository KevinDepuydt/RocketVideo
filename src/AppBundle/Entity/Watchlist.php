<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection,
    AppBundle\Entity\Videos;

/**
 * Watchlist
 */
class Watchlist
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $videos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->videos = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add video
     *
     * @param \AppBundle\Entity\Videos $video
     *
     * @return Watchlist
     */
    public function addVideo(Videos $video)
    {
        $this->videos[] = $video;

        return $this;
    }

    /**
     * Remove video
     *
     * @param \AppBundle\Entity\Videos $video
     */
    public function removeVideo(Videos $video)
    {
        $this->videos->removeElement($video);
    }

    /**
     * Get videos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVideos()
    {
        return $this->videos;
    }
}

