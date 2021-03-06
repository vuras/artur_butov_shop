<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Vich\UploaderBundle\Form\Type\VichImageType;

/**
 * Description of AdvertType
 *
 * @author Arturas
 */
class ProductType extends AbstractType
{
    /**
     * 
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $categories = $options['categories'];
        
        $builder
            ->add('name', TextType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('category', ChoiceType::class, array(
                'choices' => array_flip($categories),
                'attr' => array('class' => 'form-control')
            ))
            ->add('description', TextareaType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('price', MoneyType::class, array(
                'currency' => false,
                'attr' => array('class' => 'form-control')
            ))
            ->add('quantity', NumberType::class, array(
                'attr' => array('class' => 'form-control')
            ))
            ->add('imageFile', VichImageType::class, array(
                'required' => false,
                'allow_delete' => false, // not mandatory, default is true
                'download_link' => false, // not mandatory, default is true
            ))
            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'btn btn-default')
            ))
        ;
    }
    
    /**
     * 
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     */
    public function configureOptions(\Symfony\Component\OptionsResolver\OptionsResolver $resolver) 
    {
        $resolver->setDefaults(array('data_class' => 'AppBundle\Entity\Product' ));
        $resolver->setRequired('categories');
    }
        
    /**
     * 
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'product';
    }
}
