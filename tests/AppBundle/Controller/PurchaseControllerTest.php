<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Description of PurchaseControllerTest
 *
 * @author Arturas
 */
class PurchaseControllerTest extends WebTestCase
{
    private $client;
    
    protected function setUp()
    {
        $this->client = static::createClient();
    }
    
    public function testListPurchases()
    {
        $crawler = $this->client->request('GET', '/your_purchases');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }
    
    public function testShowPurchase()
    {
        $crawler = $this->client->request('GET', '/show_purchase/1');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }
}
