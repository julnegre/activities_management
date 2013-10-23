<?php

namespace Jng\ActivityBundle\Twig;

class JngExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return array(
            'diffToDate' => new \Twig_Filter_Method($this, 'diffToDateFilter'),
        );
    }
    
    public function diffToDateFilter($date1, $date2, $unit )
    {
        $t = $date2->getTimestamp()-$date1->getTimestamp();
        if( $unit == "s" )
            return $t." s";
        else if( $unit == "min" )
            return ($t*60)." min";
        else if( $unit == "h" )
            return ($t*60*60)." h";
        
    }
    
    

    public function getName()
    {
        return 'jng_extension';
    }
}
