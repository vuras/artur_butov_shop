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
        $id = $request->query->get('id', false);
        $product = $id ? $this->get('app.product_repository_manager')->getById($id) : new Product();
        $product->setUser($this->getUser());
        
        $formHandler = $this->get('app.form_handler');
        $form = $formHandler->create(ProductType::class, $product, [
            'categories' => $this->getParameter('categories')
        ]);
        
        if($formHandler->handle($request)){
            $this->addFlash('info', 'Product added to shop!');
            
            return $this->redirectToRoute('index');
        }
        
        return $this->render('AppBundle:Product:new.html.twig', [ 
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route("/edit_product/{id}", name="edit_product")
     */
    public function editProductAction(Request $request, int $id)
    {
        return $this->redirectToRoute('new_product', [
            'id' => $id
        ]);
    }
    
    /**
     * @Route("/show_product/{id}", name="show_product")
     */
    public function showProductAction(int $id)
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
     * @Route("your_buy_requests", name="your_buy_requests")
     */
    public function listBuyRequests(Request $request)
    {
        $products = $this->get('app.product_repository_manager')->getAll($this->getUser());
        $pagination = $this->get('app.paginator')->paginate($products);
        
    	return $this->render('AppBundle:Product:list_user_buy_requests.html.twig', [
    		'pagination' => $pagination,
	]);
    }
    
    /**
     * @Route("remove_product/{id}", name="remove_product")
     */
    public function removeProductAction(int $id)
    {
        $productRepositoryManager = $this->get('app.product_repository_manager');
        $product = $productRepositoryManager->removeById($id);
        
        $this->addFlash('info', 'Item removed from shop');
        
        return $this->redirectToRoute('your_products');
    }
    
    /**
     * @Route("order_by/{by}/{direction}", options={"expose"=true}, name="order_by")
     */
    public function orderByAction(string $by, string $direction)
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
    public function filterByAction(string $by, string $value)
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
