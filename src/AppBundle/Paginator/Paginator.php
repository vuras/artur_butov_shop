<?php

namespace AppBundle\Paginator;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Description of Paginator
 *
 * @author Arturas
 */
class Paginator 
{
    private $paginator;
    private $request;
    
    public function __construct(PaginatorInterface $paginator, RequestStack $request) {
        $this->paginator = $paginator;
        $this->request = $request;
    }
    
    public function paginate($items)
    {
        $pagination = $this->paginator->paginate(
	        $items,
	        $this->request->getCurrentRequest()->query->getInt('page', 1) /*page number*/,
	        5 /*limit per page*/
    	);
        
        return $pagination;
    }
}
