<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CultureRepository")
 */
class Culture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $year;

    /**
     * @var Collection
     * 
     * @ORM\ManyToMany(targetEntity="App\Entity\Plants", inversedBy="cultures")
     * @ORM\JoinTable(name="culture_plants",
     *      joinColumns={
     *          @ORM\JoinColumn(name="culture_id", referencedColumnName="id")
     *      },
     *      inverseJoinColumns={
     *          @ORM\JoinColumn(name="plants_id", referencedColumnName="id")
     *      }
     * )
     */
    private $pants;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateSpray;

    /**
     * @ORM\Column(type="boolean")
     * Représente le matin ou l'après midi
     */
    private $period;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Photo", inversedBy="culture")
     */
    private $photo;

    public function __construct()
    {
        $this->pants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?\DateTimeInterface
    {
        return $this->year;
    }

    public function setYear(\DateTimeInterface $year): self
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return Collection|plants[]
     */
    public function getPants(): Collection
    {
        return $this->pants;
    }

    public function addPants(plants $pants): self
    {
        if (!$this->pants->contains($pants)) {
            $this->pants[] = $pants;
        }

        return $this;
    }

    public function removePants(plants $pants): self
    {
        if ($this->pants->contains($pants)) {
            $this->pants->removeElement($pants);
        }

        return $this;
    }

    public function getDateSpray(): ?\DateTimeInterface
    {
        return $this->dateSpray;
    }

    public function setDateSpray(\DateTimeInterface $dateSpray): self
    {
        $this->dateSpray = $dateSpray;

        return $this;
    }

    public function getPeriod(): ?bool
    {
        return $this->period;
    }

    public function setPeriod(bool $period): self
    {
        $this->period = $period;

        return $this;
    }

    public function getPhoto(): ?Photo
    {
        return $this->photo;
    }

    public function setPhoto(?Photo $photo): self
    {
        $this->photo = $photo;

        return $this;
    }
}
