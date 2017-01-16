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
    /**
     *
     * @var PaginatorInterface
     */
    private $paginator;
    
    /**
     *
     * @var RequestStack 
     */
    private $request;
    
    /**
     * 
     * @param PaginatorInterface $paginator
     * @param RequestStack $request
     */
    public function __construct(PaginatorInterface $paginator, RequestStack $request) {
        $this->paginator = $paginator;
        $this->request = $request;
    }
    
    /**
     * 
     * @param type $items
     * @return PaginationInterface
     */
    public function paginate($items)
    {
        $pagination = $this->paginator->paginate(
	        $items,
	        $this->request->getCurrentRequest()->query->getInt('page', 1) /*page number*/,
	        8 /*limit per page*/
    	);
        
        return $pagination;
    }
}
