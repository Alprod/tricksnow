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
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $updateAt;


    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }


    public function getUpdateAt(): DateTimeInterface
    {
        return $this->updateAt;
    }

    /**
     * @param DateTimeInterface $updateAt
     */
    public function setUpdateAt(DateTimeInterface $updateAt): void
    {
        $this->updateAt = $updateAt;
    }



}