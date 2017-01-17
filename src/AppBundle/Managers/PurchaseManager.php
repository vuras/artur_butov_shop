<?php

namespace AppBundle\Managers;

use AppBundle\Entity\Purchase;
use AppBundle\Entity\PurchaseProduct;
use AppBundle\Entity\Cart;
use AppBundle\Repository\Managers\RepositoryManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Description of PurchaseManager
 *
 * @author Arturas
 */
class PurchaseManager 
{
    /**
     *
     * @var RepositoryManagerInterface 
     */
    private $purchaseRepositoryManager;
    
    /**
     *
     * @var Purchase 
     */
    private $purchase;
    
    /**
     * 
     * @param RepositoryManagerInterface $purchaseRepositoryManager
     */
    public function __construct(RepositoryManagerInterface $purchaseRepositoryManager) 
    {
        $this->purchaseRepositoryManager = $purchaseRepositoryManager;
        $this->purchase = new Purchase();
    }

    /**
     * Creates a Purchase from products added in cart
     * 
     * @param Cart $cart
     * @param UserInterface $user
     * @return Purchase
     */
    public function createPurchaseFromCart(Cart $cart, UserInterface $user)
    {
        $this->purchase->setTotal($cart->getTotal());
        $this->purchase->setUser($user);
        $this->purchaseRepositoryManager->add($this->purchase);
        foreach($cart->getProducts() as $product){
            $purchaseProduct = new PurchaseProduct();
            $purchaseProduct->setPurchase($this->purchase);
            $purchaseProduct->setProduct($product);
            $purchaseProduct->setQuantity($product->getQuantity());
            $this->purchaseRepositoryManager->merge($purchaseProduct);
        }
        
        $this->purchaseRepositoryManager->flush();
        
        return $this->purchase;
    }
}
