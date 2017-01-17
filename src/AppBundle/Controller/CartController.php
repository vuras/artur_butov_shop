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
        $cart = $this->get('app.cart_manager')->getCart();
        
        return $this->render('AppBundle:Cart:list_items.html.twig', [
            'cart' => $cart
        ]);
    }
    
    /**
     * @Route("add_to_cart/{id}/{quantity}/{update}", options={"expose"=true}, name="add_to_cart")
     */
    public function addToCartAction(Request $request, $id, int $quantity, int $update)
    {
        $product = $this->get('app.product_repository_manager')->getById($id);
        $product->setQuantity($quantity);
        
        $cartManager = $this->get('app.cart_manager')->addToCart($product, $update);
        
        if($update){
            $this->addFlash('info', 'Cart updated');
            
            return $this->redirectToRoute('cart');
        }
        
        $this->addFlash('info', 'Product added to cart');
        
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
        
        $cartManager = $this->get('app.cart_manager');
        $cart = $cartManager->getCart();
        $this->get('app.purchase_manager')->createPurchaseFromCart($cart, $this->getUser());
        $this->get('app.product_manager')->updateQuantities($cart->getProducts());
        $cartManager->removeCart();
        
        $this->addFlash('info', 'Purchase completed.');
        
        return $this->redirectToRoute('your_purchases');
    }
    
    /**
     * @Route("remove_from_cart/{id}", name="remove_from_cart")
     */
    public function removeFromCartAction(Request $request, int $id)
    {
        $product = $this->get('app.product_repository_manager')->getById($id);
        $cartManager = $this->get('app.cart_manager')->removeFromCart($product);
        
        return $this->redirectToRoute('cart');
    }
    
    /**
     * @Route("get_cart_count", options={"expose"=true}, name="get_cart_count")
     */
    public function getCartCountAction()
    {
        $count = $this->get('app.cart_manager')->getCartProductCount();
        
        return new \Symfony\Component\HttpFoundation\JsonResponse($count);
    }
}
