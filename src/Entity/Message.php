<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    use ResourceId;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $contenu;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $created_at;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="messages", fetch="EAGER")
     */
    private ?User $authorMsg;

    /**
     * @ORM\ManyToOne(targetEntity=Discussion::class, inversedBy="messages", fetch="EAGER")
     */
    private ?Discussion $discussion;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(?string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->created_at;
    }

    /**
     * @param DateTimeInterface $created_at
     */
    public function setCreatedAt(DateTimeInterface $created_at):void
    {
        $this->created_at = $created_at;
    }


    public function getAuthorMsg(): ?User
    {
        return $this->authorMsg;
    }

    public function setAuthorMsg(?User $authorMsg): self
    {
        $this->authorMsg = $authorMsg;

        return $this;
    }

    public function getDiscussion(): ?Discussion
    {
        return $this->discussion;
    }

    public function setDiscussion(?Discussion $discussion): self
    {
        $this->discussion = $discussion;

        return $this;
    }
}
