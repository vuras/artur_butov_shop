<?php

namespace AppBundle\Managers;

use AppBundle\Entity\Product;
use AppBundle\Repository\Managers\RepositoryManagerInterface;

/**
 * Description of ProductManager
 *
 * @author Arturas
 */
class ProductManager 
{
    /**
     *
     * @var RepositoryManagerInterface 
     */
    private $productRepositoryManager;
    
    /**
     *
     * @var Product 
     */
    private $product;
    
    /**
     * 
     * @param RepositoryManagerInterface $purchaseRepositoryManager
     */
    public function __construct(RepositoryManagerInterface $productRepositoryManager) 
    {
        $this->productRepositoryManager = $productRepositoryManager;
        $this->product = new Product();
    }
    
    /**
     * 
     * @param array $products
     */
    public function updateQuantities(\Doctrine\Common\Collections\ArrayCollection $products)
    {
        foreach($products as $product){
            $productChanged = $this->productRepositoryManager->getById($product->getId());
            $productChanged->setQuantity($productChanged->getQuantity() - $product->getQuantity());
            $this->productRepositoryManager->add($productChanged);
        }
        
        $this->productRepositoryManager->flush();
    }
}
