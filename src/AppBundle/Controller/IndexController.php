<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * @Route("", name="index")
     */
    public function indexAction(Request $request)
    {
        $products = $this->container->get('app.product_repository_manager')->getAll();
        $pagination = $this->container->get('app.paginator')->paginate($products);
        $categories = $this->getParameter('categories');
        
    	return $this->render('AppBundle:Index:index.html.twig', array(
            'pagination' => $pagination,
            'categories' => $categories
        ));
    }
    
     
    /**
     * @Route("order_by/{by}/{direction}", options={"expose"=true}, name="order_by")
     */
    public function orderByAction($by, $direction)
    {
        $products = $this->container->get('app.product_repository_manager')->getOrdered($by, $direction);
        $pagination = $this->container->get('app.paginator')->paginate($products);
        $categories = $this->getParameter('categories');
        
    	return $this->render('AppBundle:Index:index.html.twig', array(
            'pagination' => $pagination,
            'categories' => $categories
        ));
    }
    
    /**
     * @Route("filter_by/{by}/{value}", options={"expose"=true}, name="filter_by")
     */
    public function filterByAction($by, $value)
    {
        $products = $this->container->get('app.product_repository_manager')->getFiltered($by, $value);
        $pagination = $this->container->get('app.paginator')->paginate($products);
        $categories = $this->getParameter('categories');
        
    	return $this->render('AppBundle:Index:index.html.twig', array(
            'pagination' => $pagination,
            'categories' => $categories
        ));
    }
    
}
