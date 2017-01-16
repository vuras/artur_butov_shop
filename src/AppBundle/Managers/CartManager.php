<?php

namespace AppBundle\Managers;

use AppBundle\Entity\Cart;
use AppBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Description of CartManager
 *
 * @author artbut
 */
class CartManager 
{
    /**
     *
     * @var Session 
     */
    private $session;
    
    /**
     *
     * @var Cart
     */
    public $cart;
    
    /**
     * Constructor
     */
    public function __construct(Session $session) 
    {
        $this->session = $session;
        if($this->session->has('cart')){
            $this->cart = $this->session->get('cart');
        } else {
            $this->cart = new Cart();
        }
    }
    
    /**
     * 
     * @return Cart
     */
    public function getCart()
    {
        return $this->cart;
    }
    
    /**
     * 
     * @param Cart $cart
     */
    public function setCart(Cart $cart)
    {
        $this->cart = $cart;
    }
    
    /**
     * 
     * @param Product $product
     * @return boolean
     */
    public function addToCart(Product $product, $update = false)
    {
        if($this->existsInCart($product)){
            $productInCart = $this->cart->getProduct($product);
            if($update){
                $this->cart->updateTotal(-abs($productInCart->getQuantity() * $productInCart->getPrice()));
                $productInCart->setQuantity($product->getQuantity());
            } else{
                $productInCart->updateQuantity($product->getQuantity());
            }
            
            $this->cart->updateTotal($product->getQuantity() * $product->getPrice());
            
            return true;
        }
        
        $this->cart->addProduct($product);
        $this->cart->updateTotal($product->getQuantity() * $product->getPrice());
        $this->saveCart();
        
        return true;
    }
    
    /**
     * 
     * @param Product $product
     * @return Cart
     */
    public function removeFromCart(Product $product)
    {
        $productInCart = $this->cart->getProduct($product);
        $this->cart->removeProduct($productInCart);
        $this->cart->updateTotal(-abs($productInCart->getQuantity() * $productInCart->getPrice()));
        $this->isEmpty() ? $this->removeCart() : $this->saveCart();
        
        return $this->cart;
    }
    
    /**
     * 
     * @return boolean
     */
    public function isEmpty()
    {
        return $this->cart->getProducts()->isEmpty();
    }
    
    /**
     * 
     * @param Product $product
     * @return boolean
     */
    public function existsInCart(Product $product)
    {
        foreach($this->cart->getProducts() as $p){
            if($p->getId() === $product->getId()){
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Saves Cart
     */
    public function saveCart()
    {
        $this->session->set('cart', $this->cart);
    }
    
    /**
     * Removes Cart
     */
    public function removeCart()
    {
        $this->session->remove('cart');
    }
}
