<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Monolog\DateTimeImmutable;

/**
 * @ORM\Entity(repositoryClass=MessageRepository::class)
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
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="messages")
     */
    private ?User $authorMsg;

    /**
     * @ORM\ManyToOne(targetEntity=Discussion::class, inversedBy="messages")
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
