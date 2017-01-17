<?php

namespace AppBundle\Repository\Managers;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use AppBundle\Repository\Managers\RepositoryManagerInterface;

/**
 * Description of AbstractRepositoryManager
 *
 * @author artbut
 */
abstract class AbstractRepositoryManager implements RepositoryManagerInterface
{
    /**
     *
     * @var EntityManagerInterface 
     */
    protected $em;
    
    /**
     *
     * @var EntityRepository 
     */
    protected $repository;
    
    /**
     * 
     * @param EntityRepository $repository
     */
    public function __construct(EntityManagerInterface $em, EntityRepository $repository){
        $this->em = $em;
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
    public function getById(int $id)
    {
    	return $this->repository->find($id);
    }
    
    
    /**
     * 
     * @param array $data
     */
    public function removeById(int $id)
    {
        $object = $this->getById($id);
        $this->remove($object);
        $this->flush();
    }
    
    /**
     * 
     * @param type $object
     */
    public function add($object)
    {
        $this->em->persist($object);
    }
    
    /**
     * Removes object to repository
     * 
     * @param type $object
     */
    public function remove($object)
    {
        $this->em->remove($object);
    }
    
    /**
     * 
     * @param type $item
     */
    public function merge($object)
    {
        $this->em->merge($object);
    }
    
    /**
     * 
     */
    public function flush()
    {
        $this->em->flush();
    }
}
