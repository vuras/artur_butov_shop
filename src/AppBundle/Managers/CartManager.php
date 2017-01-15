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
        if($this->existsInCart($product)){
            $productInCart = $this->cart->getProduct($product);
            $product->updateQuantity($productInCart->getQuantity());
            $this->removeFromCart($productInCart);
        }
        
        $this->cart->addProduct($product);
        $this->cart->updateTotal($product->getQuantity() * $product->getPrice());
        
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
        $this->cart->updateTotal(-abs($product->getPrice()));
        
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
}
