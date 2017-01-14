<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {
        $products = $this->container->get('app.product_manager')->getProducts();
        $pagination = $this->container->get('app.paginator')->paginate($products);
        
    	return $this->render('AppBundle:Index:index.html.twig', array(
            'pagination' => $pagination,
        ));
    }
    
}
