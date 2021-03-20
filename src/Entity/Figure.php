<?php

namespace App\Entity;

use App\Repository\FigureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Monolog\DateTimeImmutable;

/**
 * @ORM\Entity(repositoryClass=FigureRepository::class)
 */
class Figure
{
    use ResourceId;
    use Timestapable;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private ?string $title;

    /**
     * @ORM\Column(type="text")
     */
    private string $description;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="figures", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     */
    private User $author;

    /**
     * @ORM\OneToMany(targetEntity=Discussion::class, mappedBy="figures", fetch="EAGER")
     */
    private Collection $discussions;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="figures", fetch="EAGER")
     */
    private Collection $images;

    /**
     * @ORM\OneToMany(targetEntity=Video::class, mappedBy="figures",  fetch="EAGER")
     */
    private Collection $videos;

    /**
     * @ORM\ManyToOne(targetEntity=FigureGroup::class, inversedBy="figures", cascade={"persist"}, fetch="EAGER")
     */
    private $figureGroup;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->discussions = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->videos = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function setAuthor(User $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|Discussion[]
     */
    public function getDiscussions(): Collection
    {
        return $this->discussions;
    }

    public function addDiscussion(Discussion $discussion): self
    {
        if (!$this->discussions->contains($discussion)) {
            $this->discussions[] = $discussion;
            $discussion->setArticles($this);
        }

        return $this;
    }

    public function removeDiscussion(Discussion $discussion): self
    {
        if ($this->discussions->removeElement($discussion)) {
            // set the owning side to null (unless already changed)
            if ($discussion->getArticles() === $this) {
                $discussion->setArticles(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setFigures($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getFigures() === $this) {
                $image->setFigures(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Video[]
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
            $video->setFigures($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->removeElement($video)) {
            // set the owning side to null (unless already changed)
            if ($video->getFigures() === $this) {
                $video->setFigures(null);
            }
        }

        return $this;
    }

    public function getFigureGroup(): ?FigureGroup
    {
        return $this->figureGroup;
    }

    public function setFigureGroup(?FigureGroup $figureGroup): self
    {
        $this->figureGroup = $figureGroup;

        return $this;
    }
}
