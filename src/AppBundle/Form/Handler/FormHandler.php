<?php

namespace AppBundle\Form\Handler;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of FormHandler
 *
 * @author Arturas
 */
class FormHandler 
{
    /**
     *
     * @var FormFactoryInterface 
     */
    private $formFactory;
    
    /**
     *
     * @var EntityManagerInterface 
     */
    private $em;
    
    /**
     *
     * @var Form 
     */
    public $form;
    
    /**
     * 
     * @param FormFactoryInterface $formFactory
     * @param EntityManagerInterface $repositoryManager
     */
    public function __construct(FormFactoryInterface $formFactory, EntityManagerInterface $em) 
    {
        $this->formFactory = $formFactory;
        $this->em = $em;
        $this->form = null;
    }
    
    /**
     * 
     * @param type $type
     * @param mixes $data
     * @param array $options
     * @return Form
     */
    public function create($type, $data = null, $options = [])
    {
        $form = $this->formFactory->create($type, $data, $options);
        $this->setForm($form);
        
        return $this->form;
    }
    
    /**
     * 
     * @param Request $request
     * @return boolean
     */
    public function handle(Request $request)
    {
        $this->form->handleRequest($request);
        
        if($this->form->isValid() && $this->form->isSubmitted()){
            $data = $this->form->getData();
            if(!is_null($data)){
                $this->em->persist($data);
                $this->em->flush();

                return true;
            }
        }
        
        return false;
    }
    
    /**
     * 
     * @param Form $form
     */
    public function setForm(Form $form)
    {
        $this->form = $form;
    }
}
