<?php

namespace AppBundle\Repository\Managers;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use AppBundle\Repository\Managers\RepositoryManagerInterface;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductRepositoryManager
 *
 * @author Arturas
 */
class ProductRepositoryManager implements RepositoryManagerInterface
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
    
    /**
     * 
     * @param string $by
     * @param string $direction
     */
    public function getOrdered($by, $direction)
    {
        return $this->repository->findOrderedBy($by, $direction);
    }
    
    /**
     * 
     * @param string $by
     * @param string $value
     */
    public function getFiltered($by, $value)
    {
        return $this->repository->findBy([
            $by => $value
        ]);
    }
}
