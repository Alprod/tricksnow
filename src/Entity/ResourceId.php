<?php


namespace App\Entity;


trait ResourceId
{
    private $id;

    /**
     * @return mixed
     */
    public function getId():int
    {
        return $this->id;
    }

}