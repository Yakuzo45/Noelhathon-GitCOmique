<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServiceRepository")
 */
class Service
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EditionService", mappedBy="service")
     */
    private $editionServices;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;
     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\StartUp", inversedBy="service")
     */
    private $startUp;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Satisfaction", mappedBy="service")
     */
    private $satisfactions;

    public function __construct()
    {
        $this->editionServices = new ArrayCollection();
        $this->satisfactions = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|EditionService[]
     */
    public function getEditionServices(): Collection
    {
        return $this->editionServices;
    }

    public function addEditionService(EditionService $editionService): self
    {
        if (!$this->editionServices->contains($editionService)) {
            $this->editionServices[] = $editionService;
            $editionService->setService($this);
        }

        return $this;
    }

    public function removeEditionService(EditionService $editionService): self
    {
        if ($this->editionServices->contains($editionService)) {
            $this->editionServices->removeElement($editionService);
            // set the owning side to null (unless already changed)
            if ($editionService->getService() === $this) {
                $editionService->setService(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
    }

    public function setStartUp(?StartUp $startUp): self
    {
        $this->startUp = $startUp;

        return $this;
    }

    /**
     * @return Collection|Satisfaction[]
     */
    public function getSatisfactions(): Collection
    {
        return $this->satisfactions;
    }

    public function addSatisfaction(Satisfaction $satisfaction): self
    {
        if (!$this->satisfactions->contains($satisfaction)) {
            $this->satisfactions[] = $satisfaction;
            $satisfaction->setService($this);
        }

        return $this;
    }

    public function removeSatisfaction(Satisfaction $satisfaction): self
    {
        if ($this->satisfactions->contains($satisfaction)) {
            $this->satisfactions->removeElement($satisfaction);
            // set the owning side to null (unless already changed)
            if ($satisfaction->getService() === $this) {
                $satisfaction->setService(null);
            }
        }

        return $this;
    }

    public function getStartUp(): ?StartUp
    {
        return $this->startUp;
    }
}
