<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plant
 *
 * @ORM\Table(name="plant")
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\PlantRepository")
 */
class Plant
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, length=11)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=false, length=255)
     */
    private $name;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Plant
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param int $name
     * @return Plant
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

}