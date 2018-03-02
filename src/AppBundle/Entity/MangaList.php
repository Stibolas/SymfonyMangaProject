<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MangaList
 *
 * @ORM\Table(name="manga_list")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MangaListRepository")
 */
class MangaList
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=500, nullable=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="volume_number", type="integer")
     */
    private $volumeNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="picture_front", type="string", length=500, nullable=true)
     */
    private $pictureFront;

    /**
     * @var string
     *
     * @ORM\Column(name="picture_side", type="string", length=255, nullable=true)
     */
    private $pictureSide;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MangaListCollection", inversedBy="mangas")
     * @ORM\JoinColumn(nullable=true)
     */
    private $collection;


    /**
     * Get id
     *
     * @return int
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
     * @return MangaList
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
     * Set volumeNumber
     *
     * @param integer $volumeNumber
     *
     * @return MangaList
     */
    public function setVolumeNumber($volumeNumber)
    {
        $this->volumeNumber = $volumeNumber;

        return $this;
    }

    /**
     * Get volumeNumber
     *
     * @return int
     */
    public function getVolumeNumber()
    {
        return $this->volumeNumber;
    }

    /**
     * Set pictureFront
     *
     * @param string $pictureFront
     *
     * @return MangaList
     */
    public function setPictureFront($pictureFront)
    {
        $this->pictureFront = $pictureFront;

        return $this;
    }

    /**
     * Get pictureFront
     *
     * @return string
     */
    public function getPictureFront()
    {
        return $this->pictureFront;
    }

    /**
     * Set pictureSide
     *
     * @param string $pictureSide
     *
     * @return MangaList
     */
    public function setPictureSide($pictureSide)
    {
        $this->pictureSide = $pictureSide;

        return $this;
    }

    /**
     * Get pictureSide
     *
     * @return string
     */
    public function getPictureSide()
    {
        return $this->pictureSide;
    }

    /**
     * @return mixed
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @param mixed $collection
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;
    }

}

