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
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->addFlash('info', 'Please login or register');
            
            return $this->redirectToRoute('fos_user_security_login');
        }
        
        $session = $request->getSession();
        $cart = $session->get('cart');
        
        return $this->render('AppBundle:Cart:list_items.html.twig', [
            'cart' => $cart
        ]);
    }
    
    /**
     * @Route("add_to_cart/{id}", name="add_to_cart")
     */
    public function addToCartAction(Request $request, $id)
    {
        $session = $request->getSession();
        
        $product = $this->get('app.product_manager')->getProductById($id);
        
        $cartManager = $this->get('app.cart_manager');
        $cartManager->addToCart($product);
        
        $session->set('cart', $cartManager->getCart());
        
        return $this->redirectToRoute('index');
    }
    
    /**
     * @Route("buy", name="buy")
     */
    public function buyAction(Request $request)
    {
        return new \Symfony\Component\HttpFoundation\Response();
    }
}
