<?php

namespace Jng\ActivityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text');
        $builder->add('customer_id', 'choice', array(
            'choices'   => array('m' => 'Masculin', 'f' => 'Féminin'),
            'required'  => false,
        ));
    }

    public function getName()
    {
        return 'activity';
    }
}
