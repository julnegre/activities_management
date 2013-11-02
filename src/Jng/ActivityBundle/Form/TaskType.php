<?php

namespace Jng\ActivityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Jng\ActivityBundle\Entity\Repository\ActivityRepository;


class TaskType extends AbstractType
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
            ->add('order_nb')
            ->add('activity','entity', array('class'=>'Jng\ActivityBundle\Entity\Activity',
                'property'=>'name',
                'query_builder' => function(ActivityRepository $er) use ($user) 
                    {
                            return $er->getActivitiesForUser($user);
                    }));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jng\ActivityBundle\Entity\Task'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'jng_activitybundle_task';
    }
}
