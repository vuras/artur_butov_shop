<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {
        $adverts = $this->container->get('app.product_manager')->getProducts();
        $pagination = $this->container->get('app.paginator')->paginate($adverts);
        
    	return $this->render('AppBundle:Default:index.html.twig', array(
    		'pagination' => $pagination,
	    ));
    }
    
    /**
     * @Route("/new", name="new")
     */
    public function newProductAction(Request $request)
    {
        $advert = new Product();
        $advert->setUser($this->getUser());
        
        $form = $this->createForm(ProductType::class, $advert);
        
        $form->handleRequest($request);
        
        if($form->isValid() && $form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($advert);
            $em->flush();
            
            return $this->redirectToRoute('index');
        }
        
        return $this->render('AppBundle:Default:new.html.twig', [ 'form' => $form->createView()]);
    }
    
    /**
     * @Route("/my", name="my")
     */
    public function myProductsAction(Request $request){
        $adverts = $this->container->get('app.product_manager')->getProducts($this->getUser());
        $pagination = $this->container->get('app.paginator')->paginate($adverts);
        
    	return $this->render('AppBundle:Default:index.html.twig', array(
    		'pagination' => $pagination,
	    ));
    }
}
