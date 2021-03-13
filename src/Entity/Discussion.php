<?php

namespace App\Entity;

use App\Repository\DiscussionRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Monolog\DateTimeImmutable;

/**
 * @ORM\Entity(repositoryClass=DiscussionRepository::class)
 */
class Discussion
{
    use ResourceId;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="discussion")
     */
    private Collection $messages;

    /**
     * @ORM\ManyToOne(targetEntity=Figure::class, inversedBy="discussions")
     */
    private ?Figure $figures;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $created_at;


    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
    }


    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setDiscussion($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getDiscussion() === $this) {
                $message->setDiscussion(null);
            }
        }

        return $this;
    }

    public function getArticles(): ?Figure
    {
        return $this->figures;
    }

    public function setArticles(?Figure $figures): self
    {
        $this->figures = $figures;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->created_at;
    }

    /**
     * @param DateTimeInterface $created_at
     */
    public function setCreatedAt(DateTimeInterface $created_at): void
    {
        $this->created_at = $created_at;
    }



}
