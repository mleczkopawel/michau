<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SurfaceFertilizer
 *
 * @ORM\Table(name="surfacefertilizer")
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\SurfaceFertilizerRepository")
 */
class SurfaceFertilizer
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
     * @ORM\ManyToOne(targetEntity="Application\Entity\Surface")
     * @ORM\JoinColumn(name="surface_id", referencedColumnName="id")
     */
    private $surfaceId;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Fertilizer")
     * @ORM\JoinColumn(name="fertilizer_id", referencedColumnName="id")
     */
    private $fertilizerId;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return SurfaceFertilizer
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
     * @return SurfaceFertilizer
     */
    public function setSurfaceId($surfaceId)
    {
        $this->surfaceId = $surfaceId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFertilizerId()
    {
        return $this->fertilizerId;
    }

    /**
     * @param mixed $fertilizerId
     * @return SurfaceFertilizer
     */
    public function setFertilizerId($fertilizerId)
    {
        $this->fertilizerId = $fertilizerId;
        return $this;
    }
}