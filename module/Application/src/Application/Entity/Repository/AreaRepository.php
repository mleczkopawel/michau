<?php

namespace Application\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class AreaRepository
 * @package Application\Entity\Repository
 */
class AreaRepository extends EntityRepository
{
	/**
	 * @return array
	 */
	public function getAllJoin() {
        $em = $this->getEntityManager();
        $query = $em->createQuery('SELECT '
                                . 'a.name AS aname, '
                                . 's.name AS sname, '
                                . 'p.name AS pname, '
                                . 'f.name AS fname, '
                                . 'a.size '
                                . 'FROM Application\Entity\Area a '
                                . 'LEFT JOIN a.surfaceId s '
                                . 'LEFT JOIN a.plantId p '
                                . 'LEFT JOIN Application\Entity\SurfaceFertilizer sf WHERE a.surfaceId = sf.surfaceId '
                                . 'LEFT JOIN Application\Entity\Fertilizer f WHERE sf.fertilizerId = f.id '
                                . 'ORDER BY aname ASC');

        return $query->getResult();
    }
}