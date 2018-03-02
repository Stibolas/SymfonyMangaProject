<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MangaListCollection
 *
 * @ORM\Table(name="manga_list_collection")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MangaListCollectionRepository")
 */
class MangaListCollection
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
     * @ORM\Column(name="title", type="string", length=500)
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer", nullable=true)
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="authors", type="string", length=500, nullable=true)
     */
    private $authors;

    /**
     * @var int
     *
     * @ORM\Column(name="count", type="integer", nullable=true)
     */
    private $count;

    /**
     * @var int
     *
     * @ORM\Column(name="muid", type="integer")
     */
    private $muid;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MangaList", mappedBy="collection")
     */
    private $mangas;

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
     * Set title
     *
     * @param string $title
     *
     * @return MangaListCollection
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set year
     *
     * @param integer $year
     *
     * @return MangaListCollection
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set authors
     *
     * @param string $authors
     *
     * @return MangaListCollection
     */
    public function setAuthors($authors)
    {
        $this->authors = $authors;

        return $this;
    }

    /**
     * Get authors
     *
     * @return string
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Set count
     *
     * @param integer $count
     *
     * @return MangaListCollection
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set muid
     *
     * @param integer $muid
     *
     * @return MangaListCollection
     */
    public function setMuid($muid)
    {
        $this->muid = $muid;

        return $this;
    }

    /**
     * Get muid
     *
     * @return int
     */
    public function getMuid()
    {
        return $this->muid;
    }

    /**
     * @return ArrayCollection|MangaList[]
     */
    public function getMangas()
    {
        return $this->mangas;
    }
}

