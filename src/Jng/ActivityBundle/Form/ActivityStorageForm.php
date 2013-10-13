<?php

namespace Jng\ActivityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

class ActivityStorageForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
  
        $builder->add('activity_id', 'entity', array(
            'class' => 'JngActivityBundle:Activity',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('a')
                    ->orderBy('a.name', 'ASC');
            },
            'property' => 'name'
        ));
            
        $builder->add('task_id', 'entity', array(
            'class' => 'JngActivityBundle:Task',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('t')
                    ->orderBy('t.name', 'ASC');
            },
            'property' => 'name',
            'required' => false        
        )); 

    }

    public function getName()
    {
        return 'activity_storage';
    }
}
