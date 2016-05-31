<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Videos
 *
 * @ORM\Table(name="videos", indexes={@ORM\Index(name="fk_videos_stream_idx", columns={"stream_id"}), @ORM\Index(name="fk_videos_video_category1_idx", columns={"video_category_id"})})
 * @ORM\Entity
 */
class Videos
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
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text", length=65535, nullable=false)
     */
    private $url;

    /**
     * @var \AppBundle\Entity\Stream
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Stream")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="stream_id", referencedColumnName="id")
     * })
     */
    private $stream;

    /**
     * @var \AppBundle\Entity\VideoCategory
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\VideoCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="video_category_id", referencedColumnName="id")
     * })
     */
    private $videoCategory;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Watchlist", mappedBy="videos")
     */
    private $watchlist;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->watchlist = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

