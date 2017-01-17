<?php

namespace Tests\AppBundle\Managers;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Description of CartManagerTest
 *
 * @author Arturas
 */
class CartManagerTest extends WebTestCase 
{
    /**
     *
     * @var CartManager
     */
    private $cartManager;
    
    /**
     *
     * @var array
     */
    private $products;
    
    /**
     * Constructor
     */
    protected function setUp()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        
        $this->cartManager = $container->get('app.cart_manager');
        
        $product1 = $this->getMock(\AppBundle\Entity\Product::class, [
            'getId', 'getPrice', 'getQuantity'
        ]);
        $product1->expects($this->any())
                ->method('getId')
                ->will($this->returnValue('1'));
        $product1->expects($this->any())
                ->method('getPrice')
                ->will($this->returnValue('5'));
        $product1->expects($this->any())
                ->method('getQuantity')
                ->will($this->returnValue('7'));
        
        $product2 = $this->getMock(\AppBundle\Entity\Product::class, [
            'getId', 'getPrice', 'getQuantity'
        ]);
        $product2->expects($this->any())
                ->method('getId')
                ->will($this->returnValue('1'));
        $product2->expects($this->any())
                ->method('getPrice')
                ->will($this->returnValue('5'));
        $product2->expects($this->any())
                ->method('getQuantity')
                ->will($this->returnValue('2'));
        
        $product3 = $this->getMock(\AppBundle\Entity\Product::class, [
            'getId', 'getPrice', 'getQuantity'
        ]);
        $product3->expects($this->any())
                ->method('getId')
                ->will($this->returnValue('2'));
        $product3->expects($this->any())
                ->method('getPrice')
                ->will($this->returnValue('2'));
        $product3->expects($this->any())
                ->method('getQuantity')
                ->will($this->returnValue('3'));
        
        $this->products = [$product1, $product2, $product3];
    }
    
    /**
     * Destructor
     */
    protected function tearDown() 
    {
        $this->cartManager = null;
        $this->products = null;
    }

    /**
     * Adding to cart test
     */
    public function testAddToCart()
    {
        $totalPrice = 0;
        foreach($this->products as $product){
            $this->cartManager->addToCart($product);
            $this->assertInstanceOf(\AppBundle\Entity\Product::class, $this->cartManager->cart->getProducts()->last());
            
            $totalPrice += $product->getPrice() * $product->getQuantity();
            $this->assertEquals($this->cartManager->getCart()->getTotal(), $totalPrice);
        }
        
    }
}
