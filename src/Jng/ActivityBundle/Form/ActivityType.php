<?php

namespace Jng\ActivityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Jng\ActivityBundle\Entity\Repository\CustomerRepository;

class ActivityType extends AbstractType {

    
    public function __construct($user)
    {
        $this->user = $user;
    }
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $user = $this->user;
        
        $builder
                ->add('name')
                ->add('customer', 'entity', array(
                    'class' => 'Jng\ActivityBundle\Entity\Customer',
                    'property' => 'name',
                    'query_builder' => function(CustomerRepository $er) use ($user) 
			{
				return $er->getCustomersForUser($user);
                        }));

    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Jng\ActivityBundle\Entity\Activity'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'jng_activitybundle_activity';
    }

}
