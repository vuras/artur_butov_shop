<?php

namespace AppBundle\Managers;

use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdvertManager
 *
 * @author Arturas
 */
class ProductManager 
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
    public function getProducts(UserInterface $user = null)
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
    public function getProductById($id)
    {
    	return $this->repository->find($id);
    }
}
