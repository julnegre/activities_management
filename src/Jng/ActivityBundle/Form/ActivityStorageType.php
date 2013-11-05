<?php

namespace Jng\ActivityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Jng\ActivityBundle\Entity\Repository\ActivityRepository;
use Jng\ActivityBundle\Entity\Repository\TaskRepository;

class ActivityStorageType extends AbstractType
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
            ->add('activity','entity', array('class'=>'Jng\ActivityBundle\Entity\Activity',
                'property'=>'name' ,
                    'query_builder' => function(ActivityRepository $er) use ($user) 
			{
				return $er->getActivitiesForUser($user);
                        }))
            ->add('task','entity', array('class'=>'Jng\ActivityBundle\Entity\Task',
                'property'=>'name' ,
                    'query_builder' => function(TaskRepository $er) use ($user) 
			{
				return $er->getTasksForUser($user);
                        }))
            ->add('start','datetime',array('widget' => 'single_text','attr' => array('class'=>'hasDatepicker'),'format' => 'dd/MM/yyyy HH:mm'))
            ->add('end','datetime',array('widget' => 'single_text','attr' => array('class'=>'hasDatepicker'),'format' => 'dd/MM/yyyy HH:mm'));
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
