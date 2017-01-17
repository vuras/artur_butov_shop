<?php

namespace AppBundle\Repository\Managers;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Repository\Managers\AbstractRepositoryManager;

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
class ProductRepositoryManager extends AbstractRepositoryManager
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
        parent::__construct($em, $repository);
    }
    
    /**
     * 
     * @param string $by
     * @param string $direction
     */
    public function getOrdered(string $by, string $direction)
    {
        return $this->repository->findOrderedBy($by, $direction);
    }
    
    /**
     * 
     * @param string $by
     * @param string $value
     */
    public function getFiltered(string $by, string $value)
    {
        return $this->repository->findBy([
            $by => $value
        ]);
    }
}
