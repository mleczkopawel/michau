<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Surface
 *
 * @ORM\Table(name="surface")
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\SurfaceRepository")
 */
class Surface
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
     * @return Surface
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
     * @return Surface
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

}