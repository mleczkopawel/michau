<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Measurment
 * @package Application\Entity
 *
 * @ORM\Table(name="measurment")
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\MeasurmentRepository")
 */
class Measurment
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
     * @ORM\ManyToOne(targetEntity="Application\Entity\Area")
     * @ORM\JoinColumn(name="area_id", referencedColumnName="id")
     */
    private $areaId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="add_date", type="datetime", nullable=false)
     */
    private $addDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=false)
     */
    private $endDate;

    /**
     * @var string
     *
     * @ORM\Column(name="measure_name", type="string", nullable=false, length=255)
     */
    private $measureName;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Measurment
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAreaId()
    {
        return $this->areaId;
    }

    /**
     * @param mixed $areaId
     * @return Measurment
     */
    public function setAreaId($areaId)
    {
        $this->areaId = $areaId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddDate()
    {
        return $this->addDate;
    }

    /**
     * @param mixed $addDate
     * @return Measurment
     */
    public function setAddDate($addDate)
    {
        $this->addDate = $addDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     * @return Measurment
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMeasureName()
    {
        return $this->measureName;
    }

    /**
     * @param mixed $measureName
     * @return Measurment
     */
    public function setMeasureName($measureName)
    {
        $this->measureName = $measureName;
        return $this;
    }

}