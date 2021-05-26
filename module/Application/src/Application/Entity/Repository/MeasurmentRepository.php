<?php

namespace Application\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class MeasurmentRepository
 * @package Application\Entity\Repository
 */
class MeasurmentRepository extends EntityRepository
{
	/**
	 * @param $id
	 * @return array
	 */
	public function getAllJoin($id) {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT '
            . 'a.name AS aname, '
            . 's.name AS sname, '
            . 'p.name AS pname, '
            . 'f.name AS fname, '
            . 'a.size, '
            . 'm.measureName AS mname, '
            . 'max(me.plantCount) AS plant_count, '
            . 'max(me.plantSize) AS plant_size, '
            . 'm.addDate, '
            . 'min(me.date) AS min_date, '
            . 'max(me.date) AS max_date, '
            . 'm.endDate '
            . 'FROM Application\Entity\Measurment m '
            . 'LEFT JOIN m.areaId a '
            . 'LEFT JOIN a.surfaceId s '
            . 'LEFT JOIN a.plantId p '
            . 'LEFT JOIN Application\Entity\SurfaceFertilizer sf WHERE a.surfaceId = sf.surfaceId '
            . 'LEFT JOIN Application\Entity\Fertilizer f WHERE sf.fertilizerId = f.id '
            . 'LEFT JOIN Application\Entity\MeasureExperience me WHERE m.id = me.measureId '
            . 'WHERE me.measureId=' . $id . ' '
            . 'ORDER BY mname ASC');

//        var_dump($query->getResult());die;

        return $query->getResult();
    }

}