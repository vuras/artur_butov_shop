<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Description of ProductRepository
 *
 * @author artbut
 */
class ProductRepository extends EntityRepository
{
    /**
     * Finds products by user if specified
     * 
     * @param UserInterface $user
     * @return type
     */
    public function findByUser(UserInterface $user = null)
    {
        return $this->createQueryBuilder('a')
                ->where('a.user = :user')
                ->setParameter('user', $user)
                ->getQuery()
                ->getResult();
    }
}
