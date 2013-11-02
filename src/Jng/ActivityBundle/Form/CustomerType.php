<?php

namespace Jng\ActivityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Jng\ActivityBundle\Entity\Repository\BusinessRepository;

class CustomerType extends AbstractType
{
        
    public function __construct($user)
    {
        $this->user = $user;
    }
    
    
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $this->user;
        $builder
            ->add('name')
            ->add('business','entity', 
                    array(
                        'class'=>'Jng\ActivityBundle\Entity\Business', 
                        'property'=>'name',
                        'query_builder' => function(BusinessRepository $er) use ($user) 
                            {
                                    return $er->getBusinessForUser($user);
                            }));
        
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jng\ActivityBundle\Entity\Customer'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'jng_activitybundle_customer';
    }
}
