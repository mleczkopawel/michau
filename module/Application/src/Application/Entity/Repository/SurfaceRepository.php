<?php

namespace Application\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class SurfaceRepository
 * @package Application\Entity\Repository
 */
class SurfaceRepository extends EntityRepository
{
	/**
	 * @return array
	 */
	public function getAllJoin() {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT '
                                . 's.id AS sid, '
                                . 's.name AS sname, '
                                . 'f.id AS fid, '
                                . 'f.name AS fname '
                                . 'FROM Application\Entity\Surface s '
                                . 'LEFT JOIN Application\Entity\SurfaceFertilizer sf WHERE s.id = sf.surfaceId '
                                . 'LEFT JOIN Application\Entity\Fertilizer f WHERE sf.fertilizerId = f.id '
                                . 'ORDER BY sname ASC');

        return $query->getResult();
    }

}