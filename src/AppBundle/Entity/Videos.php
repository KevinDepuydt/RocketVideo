<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection,
    AppBundle\Entity\Stream,
    AppBundle\Entity\Watchlist,
    AppBundle\Entity\VideoCategory;

/**
 * Videos
 */
class Videos
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $url;

    /**
     * @var \AppBundle\Entity\Stream
     */
    private $stream;

    /**
     * @var \AppBundle\Entity\VideoCategory
     */
    private $videoCategory;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $watchlist;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->watchlist = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Videos
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Videos
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set stream
     *
     * @param \AppBundle\Entity\Stream $stream
     *
     * @return Videos
     */
    public function setStream(Stream $stream = null)
    {
        $this->stream = $stream;

        return $this;
    }

    /**
     * Get stream
     *
     * @return \AppBundle\Entity\Stream
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * Set videoCategory
     *
     * @param \AppBundle\Entity\VideoCategory $videoCategory
     *
     * @return Videos
     */
    public function setVideoCategory(VideoCategory $videoCategory = null)
    {
        $this->videoCategory = $videoCategory;

        return $this;
    }

    /**
     * Get videoCategory
     *
     * @return \AppBundle\Entity\VideoCategory
     */
    public function getVideoCategory()
    {
        return $this->videoCategory;
    }

    /**
     * Add watchlist
     *
     * @param \AppBundle\Entity\Watchlist $watchlist
     *
     * @return Videos
     */
    public function addWatchlist(Watchlist $watchlist)
    {
        $this->watchlist[] = $watchlist;

        return $this;
    }

    /**
     * Remove watchlist
     *
     * @param \AppBundle\Entity\Watchlist $watchlist
     */
    public function removeWatchlist(Watchlist $watchlist)
    {
        $this->watchlist->removeElement($watchlist);
    }

    /**
     * Get watchlist
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWatchlist()
    {
        return $this->watchlist;
    }
}

