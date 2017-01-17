<?php

namespace Tests\AppBundle\Form\Handler;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Entity\Product;
use AppBundle\Form\Type\ProductType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

/**
 * Description of FormHandlerTest
 *
 * @author Arturas
 */
class FormHandlerTest extends WebTestCase 
{
    /**
     *
     * @var FormFactoryInterface 
     */
    private $formHandler;
    
    /**
     *
     * @var Form 
     */
    private $form;
    
    /**
     *
     * @var type 
     */
    private $entity;
    
    /**
     *
     * @var array 
     */
    private $categories;
    
    /**
     *
     * @var type 
     */
    private $requestStack;
    
    /**
     * Constructor
     */
    protected function setUp() 
    {
        $client = static::createClient();
        $container = $client->getContainer();
        
        $this->formHandler = $container->get('app.form_handler');
        $this->categories = $container->getParameter('categories');
        $this->entity = new Product();
        
        $fakeRequest = Request::create('/', 'POST');
        $fakeRequest->setSession(new Session(new MockArraySessionStorage()));
        $this->requestStack = new RequestStack();
        $this->requestStack->push($fakeRequest);
    }
    
    /**
     * Destructor
     */
    protected function tearDown() 
    {
        $this->formHandler = null;
        $this->categories = null;
        $this->entity = null;
        $this->requestStack = null;
    }
    
    /**
     * Tests Form handling
     */
    public function testFormHandling()
    {
        $form = $this->formHandler->create(ProductType::class, $this->entity, [
            'categories' => $this->categories 
        ]);
        $this->assertInstanceOf(\Symfony\Component\Form\FormInterface::class, $form);
        
        $request = $this->requestStack->getCurrentRequest();
        $handled = $this->formHandler->handle($request);
        $this->assertFalse($handled);
    }
}
