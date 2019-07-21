<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlantsRepository")
 */
class Plants
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $variety;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $water;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sun;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $waterPeriod;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Culture", mappedBy="pants")
     */
    private $cultures;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Photo", mappedBy="plant", cascade={"persist", "remove"})
     */
    private $photo;

    public function __construct()
    {
        $this->cultures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getVariety(): ?string
    {
        return $this->variety;
    }

    public function setVariety(?string $variety): self
    {
        $this->variety = $variety;

        return $this;
    }

    public function getWater(): ?int
    {
        return $this->water;
    }

    public function setWater(?int $water): self
    {
        $this->water = $water;

        return $this;
    }

    public function getSun(): ?int
    {
        return $this->sun;
    }

    public function setSun(?int $sun): self
    {
        $this->sun = $sun;

        return $this;
    }

    public function getWaterPeriod(): ?string
    {
        return $this->waterPeriod;
    }

    public function setWaterPeriod(?string $waterPeriod): self
    {
        $this->waterPeriod = $waterPeriod;

        return $this;
    }

    /**
     * @return Collection|Culture[]
     */
    public function getCultures(): Collection
    {
        return $this->cultures;
    }

    public function addCulture(Culture $culture): self
    {
        if (!$this->cultures->contains($culture)) {
            $this->cultures[] = $culture;
            $culture->addPants($this);
        }

        return $this;
    }

    public function removeCulture(Culture $culture): self
    {
        if ($this->cultures->contains($culture)) {
            $this->cultures->removeElement($culture);
            $culture->removePants($this);
        }

        return $this;
    }

    public function getPhoto(): ?Photo
    {
        return $this->photo;
    }

    public function setPhoto(?Photo $photo): self
    {
        $this->photo = $photo;

        // set (or unset) the owning side of the relation if necessary
        $newPlant = $photo === null ? null : $this;
        if ($newPlant !== $photo->getPlant()) {
            $photo->setPlant($newPlant);
        }

        return $this;
    }
}
