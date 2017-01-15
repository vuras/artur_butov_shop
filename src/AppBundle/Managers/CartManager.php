<?php

namespace AppBundle\Managers;

use AppBundle\Entity\Cart;
use AppBundle\Entity\Product;

/**
 * Description of CartManager
 *
 * @author artbut
 */
class CartManager 
{
    /**
     *
     * @var Cart
     */
    public $cart;
    
    /**
     * Constructor
     */
    public function __construct() 
    {
        $this->cart = new Cart();
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
    public function addToCart(Product $product)
    {
        $this->cart->addProduct($product);
        $this->cart->setTotal($product->getPrice());
        
        return true;
    }
    
    /**
     * 
     * @param Product $product
     * @return Cart
     */
    public function removeFromCart(Product $product)
    {
        $this->cart->removeProduct($product);
        $this->cart->setTotal(-abs($product->getPrice()));
        
        return $this->cart;
    }
    
    public function isEmpty()
    {
        return $this->cart->getProducts()->isEmpty();
    }
}
