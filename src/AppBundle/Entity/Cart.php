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
        $this->total += $total;
    }


}
