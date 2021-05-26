<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fertilizer
 *
 * @ORM\Table(name="fertilizer")
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\FertilizerRepository")
 */
class Fertilizer
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
     * @return Fertilizer
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Fertilizer
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

}