<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Element\DateTime;

/**
 * Fertilizer
 *
 * @ORM\Table(name="measureexperience")
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\MeasureExperienceRepository")
 */
class MeasureExperience
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
     * @ORM\ManyToOne(targetEntity="Application\Entity\Measurment")
     * @ORM\JoinColumn(name="measure_id", referencedColumnName="id")
     */
    private $measureId;

    /**
     * @var int
     *
     * @ORM\Column(name="plant_count", type="integer", nullable=false, length=11)
     */
    private $plantCount;

    /**
     * @var int
     *
     * @ORM\Column(name="plant_size", type="integer", nullable=false, length=11)
     */
    private $plantSize;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return MeasureExperience
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMeasureId()
    {
        return $this->measureId;
    }

    /**
     * @param mixed $measureId
     * @return MeasureExperience
     */
    public function setMeasureId($measureId)
    {
        $this->measureId = $measureId;
        return $this;
    }

    /**
     * @return int
     */
    public function getPlantCount()
    {
        return $this->plantCount;
    }

    /**
     * @param int $plantCount
     * @return MeasureExperience
     */
    public function setPlantCount($plantCount)
    {
        $this->plantCount = $plantCount;
        return $this;
    }

    /**
     * @return int
     */
    public function getPlantSize()
    {
        return $this->plantSize;
    }

    /**
     * @param int $plantSize
     * @return MeasureExperience
     */
    public function setPlantSize($plantSize)
    {
        $this->plantSize = $plantSize;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     * @return MeasureExperience
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

}