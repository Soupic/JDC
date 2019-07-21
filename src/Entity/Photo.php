<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotoRepository")
 */
class Photo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\culture", mappedBy="photo")
     */
    private $culture;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Plants")
     * @ORM\JoinColumn(name="plants_id", referencedColumnName="id")
     */
    private $plant;

    public function __construct()
    {
        $this->cu = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|culture[]
     */
    public function getCulture(): Collection
    {
        return $this->culture;
    }

    public function addCulture(culture $culture): self
    {
        if (!$this->culture->contains($culture)) {
            $this->culture[] = $culture;
            $culture->setPhoto($this);
        }

        return $this;
    }

    public function removeCu(culture $culture): self
    {
        if ($this->culture->contains($culture)) {
            $this->culture->removeElement($culture);
            // set the owning side to null (unless already changed)
            if ($culture->getPhoto() === $this) {
                $culture->setPhoto(null);
            }
        }

        return $this;
    }

    public function getPlant(): ?plants
    {
        return $this->plant;
    }

    public function setPlant(?plants $plant): self
    {
        $this->plant = $plant;

        return $this;
    }
}
