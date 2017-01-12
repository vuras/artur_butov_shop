<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;

class IndexController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {
        $adverts = $this->container->get('app.product_manager')->getProducts();
        $pagination = $this->container->get('app.paginator')->paginate($adverts);
        
    	return $this->render('AppBundle:Index:index.html.twig', array(
    		'pagination' => $pagination,
	    ));
    }
    
}
