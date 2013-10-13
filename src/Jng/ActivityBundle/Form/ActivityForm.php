<?php

namespace Jng\ActivityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

class ActivityForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text');
        
        $builder->add('customer_id', 'entity', array(
            'class' => 'JngActivityBundle:Customer',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('c')
                    ->orderBy('c.name', 'ASC');
            },
            'property' => 'name'
        ));
 

    }

    public function getName()
    {
        return 'activity';
    }
    
    public function getDefaultOptions(array $options)
    {
    return array(
        'data_class' => 'Jng\ActivityBundle\Entity\Activity',
    );
    }
    
    
}
