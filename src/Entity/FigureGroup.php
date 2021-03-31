<?php

namespace App\Entity;

use App\Repository\FigureGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FigureGroupRepository::class)
 */
class FigureGroup
{
    use ResourceId;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private ?string $title;

    /**
     * @ORM\OneToMany(targetEntity=Figure::class, mappedBy="figureGroup", cascade={"persist"})
     */
    private Collection $figures;

    public function __construct()
    {
        $this->figures = new ArrayCollection();
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

    /**
     * @return Collection|Figure[]
     */
    public function getFigures(): Collection
    {
        return $this->figures;
    }

    public function addFigure(Figure $figure): self
    {
        if (!$this->figures->contains($figure)) {
            $this->figures[] = $figure;
            $figure->setFigureGroup($this);
        }

        return $this;
    }

    public function removeFigure(Figure $figure): self
    {
        if ($this->figures->removeElement($figure)) {
            // set the owning side to null (unless already changed)
            if ($figure->getFigureGroup() === $this) {
                $figure->setFigureGroup(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {

        return $this->title;
    }
}
