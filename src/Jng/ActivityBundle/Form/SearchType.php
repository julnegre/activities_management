<?php

namespace Jng\ActivityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SearchType extends AbstractType
{
    protected $className;

    public function __construct ($className)
    {
        $this->className = $className;
    }
    
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'genemu_jqueryautocomplete_entity', array(
            'class' => $this->className,
            'property' => 'name',
        ));
    }
    

    /**
     * @return string
     */
    public function getName()
    {
        return 'jng_activitybundle_search';
    }
}
