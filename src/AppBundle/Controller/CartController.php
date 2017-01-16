<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Description of CartController
 *
 * @author artbut
 */
class CartController extends Controller
{
    /**
     * @Route("cart", name="cart")
     */
    public function listItemsAction(Request $request)
    {
        $session = $request->getSession();
        $cart = $session->get('cart');
        
        return $this->render('AppBundle:Cart:list_items.html.twig', [
            'cart' => $cart
        ]);
    }
    
    /**
     * @Route("add_to_cart/{id}/{quantity}/{update}", options={"expose"=true}, name="add_to_cart")
     */
    public function addToCartAction(Request $request, $id, $quantity, $update)
    {
        $product = $this->get('app.product_repository_manager')->getById($id);
        $product->setQuantity($quantity);
        
        $cartManager = $this->get('app.cart_manager');
        
        $session = $request->getSession();
        if($session->has('cart')){
            $cartManager->setCart($session->get('cart'));
        }
            
        $cartManager->addToCart($product, $update);
        $session->set('cart', $cartManager->getCart());
        
        $this->addFlash('info', 'Product added to cart');
        
        if($update){
            return $this->redirectToRoute('cart');
        }
        
        return $this->redirectToRoute('index');
    }
    
    /**
     * @Route("checkout", name="checkout")
     */
    public function checkoutAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->addFlash('info', 'Please login or register');
            
            return $this->redirectToRoute('fos_user_security_login');
        }
        
        $session = $request->getSession();
        $cart = $session->get('cart');
        
        $this->get('app.purchase_manager')->createPurchaseFromCart($cart, $this->getUser());
        $session->remove('cart');
        
        $this->addFlash('info', 'Purchase completed.');
        
        return $this->redirectToRoute('index');
    }
    
    /**
     * @Route("remove_from_cart/{id}", name="remove_from_cart")
     */
    public function removeFromCartAction(Request $request, $id)
    {
        $session = $request->getSession();
        $cart = $session->get('cart');
        
        $product = $this->get('app.product_repository_manager')->getById($id);
        $cartManager = $this->get('app.cart_manager');
        $cartManager->setCart($cart);
        $cart = $cartManager->removeFromCart($product);
        
        $cartManager->isEmpty() ? $session->remove('cart') : $session->set('cart', $cart);
        
        return $this->redirectToRoute('cart');
    }
}
