<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * GoodRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GoodRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->findBy(array(), array('category' => 'ASC'));
    }
}
