<?php

namespace AppBundle\Managers;

use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\EntityManager;
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
    private $em;
    
    public function __construct( EntityManager $em) {
        $this->em = $em;
    }
    
    public function getProducts($user = false)
    {
    	$repository = $this->em->getRepository('AppBundle:Product');
        
    	$query = $repository->createQueryBuilder('a');
        
        if($user)
            $query->where('a.user = :user')
                  ->setParameter('user', $user);
        
        $adverts = $query->getQuery()
                         ->getResult();
        
        return $adverts;
    }
    
    
}
