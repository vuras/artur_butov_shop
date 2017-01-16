<?php

namespace AppBundle\Repository\Managers;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use AppBundle\Repository\Managers\RepositoryManagerInterface;

/**
 * Description of PurchaseRepositoryManager
 *
 * @author Arturas
 */
class PurchaseRepositoryManager implements RepositoryManagerInterface
{
    /**
     *
     * @var EntityRepository 
     */
    private $repository;
    
    /**
     * 
     * @param EntityRepository $repository
     */
    public function __construct(EntityRepository $repository){
        $this->repository = $repository;
    }
    
    /**
     * 
     * @param UserInterface $user
     * @return type
     */
    public function getAll(UserInterface $user = null)
    {
        if(is_null($user))
            return $this->repository->findAll();
        
        return $this->repository->findByUser($user);
    }
    
    /**
     * 
     * @param int $id
     * @return type
     */
    public function getById($id)
    {
    	return $this->repository->find($id);
    }
    
}
