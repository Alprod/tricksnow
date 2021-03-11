<?php

namespace App\Entity;

use App\Repository\GroupFigureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupFigureRepository::class)
 */
class GroupFigure
{
    use ResourceId;

    /**
     * @ORM\Column(type="string", length=90)
     */
    private ?string $title;

    /**
     * @ORM\OneToMany(targetEntity=Figure::class, mappedBy="groupFigure")
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
            $figure->setGroupFigure($this);
        }

        return $this;
    }

    public function removeFigure(Figure $figure): self
    {
        if ($this->figures->removeElement($figure)) {
            // set the owning side to null (unless already changed)
            if ($figure->getGroupFigure() === $this) {
                $figure->setGroupFigure(null);
            }
        }

        return $this;
    }
}
