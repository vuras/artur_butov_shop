<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Product;

/**
 * Description of Cart
 *
 * @author artbut
 */
class Cart 
{
    /**
     *
     * @var array
     */
    protected $products;

    /**
     *
     * @var float
     */
    protected $total;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * 
     * @return array
     */
    public function getProducts() 
    {
        return $this->products;
    }

    /**
     * 
     * @return float
     */
    public function getTotal() 
    {
        return $this->total;
    }

    /**
     * 
     * @param Product $product
     */
    public function addProduct(Product $product)
    {
        $this->products[] = $product;
        
        return $this;
    }
    
    /**
     * 
     * @param Product $product
     */
    public function removeProduct(Product $product)
    {
        foreach($this->products as $p){
            if($p->getId() === $product->getId()){
                $this->products->removeElement($p);
            }
        }
    }
    
    /**
     * 
     * @param Product $product
     * @return boolean
     */
    public function getProduct(Product $product)
    {
        foreach($this->products as $p){
            if($p->getId() === $product->getId()){
                return $p;
            }
        }
    }
    
    /**
     * 
     * @param array $products
     */
    public function setProducts($products) 
    {
        $this->products = $products;
    }

    /**
     * 
     * @param float $total
     */
    public function setTotal($total) 
    {
        $this->total = $total;
    }
    
    /**
     * 
     * @param float $total
     */
    public function updateTotal($total) 
    {
        $this->total += $total;
    }


}
