<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

trait ResourceId
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    public function getId():int
    {
        return $this->id;
    }

}