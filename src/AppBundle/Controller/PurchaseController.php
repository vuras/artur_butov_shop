<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of PurchaseController
 *
 * @author Arturas
 */
class PurchaseController extends Controller
{
    /**
     * @Route("your_purchases", name="your_purchases")
     */
    public function listPurchases(Request $request)
    {
        $purchases = $this->get('app.purchase_repository_manager')->getAll($this->getUser());
        $pagination = $this->get('app.paginator')->paginate($purchases);
        
    	return $this->render('AppBundle:Purchase:list_user_purchases.html.twig', [
    		'pagination' => $pagination,
	]);
    }
    
    /**
     * @Route("/show_purchase/{id}", name="show_purchase")
     */
    public function showPurchaseAction($id)
    {
        $purchase = $this->get('app.purchase_repository_manager')->getById($id);
        
        return $this->render('AppBundle:Purchase:item.html.twig', [
            'purchase' => $purchase
        ]);
    }
}
