<?php

namespace Jng\ActivityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ActivityStorageType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('activity','entity', array('class'=>'Jng\ActivityBundle\Entity\Activity', 'property'=>'name' ))
            ->add('task','entity', array('class'=>'Jng\ActivityBundle\Entity\Task', 'property'=>'name' ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jng\ActivityBundle\Entity\ActivityStorage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'jng_activitybundle_activitystorage';
    }
}
