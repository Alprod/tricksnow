<?php


namespace App\Entity;


use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

trait Timestapable
{
    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $updateAt;


    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeInterface $createdAt
     */
    public function setCreatedAt(DateTimeInterface $createdAt): void {
        $this->createdAt = $createdAt;
    }


    public function getUpdateAt(): ?DateTimeInterface
    {
        return $this->updateAt;
    }

    /**
     * @param DateTimeInterface|null $updateAt
     */
    public function setUpdateAt(?DateTimeInterface $updateAt): void
    {
        $this->updateAt = $updateAt;
    }

}