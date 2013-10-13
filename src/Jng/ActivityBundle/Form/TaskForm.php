<?php

namespace Jng\ActivityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

class TaskForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text');
        
        $builder->add('activity_id', 'entity', array(
            'class' => 'JngActivityBundle:Activity',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('c')
                    ->orderBy('c.name', 'ASC');
            },
            'property' => 'name'
        ));
 
        $builder->add('order', 'choice',array(
            'choices' => range(0,15)
        ));    

    }

    public function getName()
    {
        return 'task';
    }
    
    public function getDefaultOptions(array $options)
    {
    return array(
        'data_class' => 'Jng\ActivityBundle\Entity\Task',
    );
    }
}
