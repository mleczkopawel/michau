<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Area
 *
 * @ORM\Table(name="area")
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\AreaRepository")
 */
class Area
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Surface")
     * @ORM\JoinColumn(name="surface_id", referencedColumnName="id")
     */
    private $surfaceId;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Plant")
     * @ORM\JoinColumn(name="plant_id", referencedColumnName="id")
     */
    private $plantId;

    /**
     * @var int
     *
     * @ORM\Column(name="size", type="integer", nullable=false, length=11)
     */
    private $size;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=false)
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
     * @return Area
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSurfaceId()
    {
        return $this->surfaceId;
    }

    /**
     * @param mixed $surfaceId
     * @return Area
     */
    public function setSurfaceId($surfaceId)
    {
        $this->surfaceId = $surfaceId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlantId()
    {
        return $this->plantId;
    }

    /**
     * @param mixed $plantId
     * @return Area
     */
    public function setPlantId($plantId)
    {
        $this->plantId = $plantId;
        return $this;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param int $size
     * @return Area
     */
    public function setSize($size)
    {
        $this->size = $size;
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
     * @return Area
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }



}