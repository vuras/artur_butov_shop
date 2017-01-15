<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
use AppBundle\Form\Type\ProductType;

class ProductController extends Controller
{
    /**
     * @Route("/new_product", name="new_product")
     */
    public function newProductAction(Request $request)
    {
        $product = new Product();
        $product->setUser($this->getUser());
        $categories = $this->getParameter('categories');
        
        $form = $this->createForm(ProductType::class, $product, [
            'categories' => $categories
        ]);
        
        $form->handleRequest($request);
        
        if($form->isValid() && $form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            
            return $this->redirectToRoute('index');
        }
        
        return $this->render('AppBundle:Product:new.html.twig', [ 
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route("/show_product/{id}", name="show_product")
     */
    public function showProductAction($id)
    {
        $product = $this->get('app.product_repository_manager')->getById($id);
        
        return $this->render('AppBundle:Product:item.html.twig', [
            'product' => $product
        ]);
    }
    
    /**
     * @Route("/your_products", name="your_products")
     */
    public function yourProductsAction(Request $request){
        $products = $this->get('app.product_repository_manager')->getAll($this->getUser());
        $pagination = $this->get('app.paginator')->paginate($products);
        
    	return $this->render('AppBundle:Product:list_user_products.html.twig', [
    		'pagination' => $pagination,
	]);
    }
    
    /**
     * @Route("remove_product/{id}", name="remove_product")
     */
    public function removeProductAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $product = $this->get('app.product_repository_manager')->getById($id);
        
        $em->remove($product);
        $em->flush();
        
        return $this->redirectToRoute('my_products');
    }
    
}
