<?php

namespace AppBundle\Managers;

use AppBundle\Entity\Purchase;
use AppBundle\Entity\PurchaseProduct;
use AppBundle\Entity\Cart;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Description of PurchaseManager
 *
 * @author Arturas
 */
class PurchaseManager 
{
    private $em;
    
    private $purchase;
    
    public function __construct(EntityManager $em) 
    {
        $this->em = $em;
        $this->purchase = new Purchase();
    }

    public function createPurchaseFromCart(Cart $cart, UserInterface $user)
    {
        $this->purchase->setTotal($cart->getTotal());
        $this->purchase->setUser($user);
        $this->em->persist($this->purchase);
        foreach($cart->getProducts() as $product){
            $purchaseProduct = new PurchaseProduct();
            $purchaseProduct->setPurchase($this->purchase);
            $purchaseProduct->setProduct($product);
            $purchaseProduct->setQuantity($product->getQuantity());
            $this->em->merge($purchaseProduct);
        }
        
        $this->em->flush();
        
        return $this->purchase;
    }
}
