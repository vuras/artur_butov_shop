<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;

class ProductController extends Controller
{
    /**
     * @Route("/new_product", name="new_product")
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
        
        return $this->render('AppBundle:Product:new.html.twig', [ 'form' => $form->createView()]);
    }
    
    /**
     * @Route("/my_products", name="my_products")
     */
    public function myProductsAction(Request $request){
        $adverts = $this->container->get('app.product_manager')->getProducts($this->getUser());
        $pagination = $this->container->get('app.paginator')->paginate($adverts);
        
    	return $this->render('AppBundle:Index:index.html.twig', array(
    		'pagination' => $pagination,
	    ));
    }
    
}
