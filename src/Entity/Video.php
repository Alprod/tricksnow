<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Monolog\DateTimeImmutable;

/**
 * @ORM\Entity(repositoryClass=VideoRepository::class)
 */
class Video
{
    use ResourceId;

    /**
     * @ORM\Column(type="string", length=90, nullable=true)
     */
    private ?string $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $link;

    /**
     * @ORM\ManyToOne(targetEntity=Figure::class, inversedBy="videos")
     */
    private ?Figure $figures;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $created_at;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
    }


    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getFigures(): ?Figure
    {
        return $this->figures;
    }

    public function setFigures(?Figure $figures): self
    {
        $this->figures = $figures;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

}
