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
    
    public function diffToDateFilter($date1, $date2, $unit=null )
    {
        if( is_null($date2) )
            return;
        
        $t = $date2->getTimestamp()-$date1->getTimestamp();
        
        if( is_null($unit) ){
            $unit="s";
            if( $t >= 3600)
                $unit = "h";
            else if( $t >= 60)
                $unit = "min";
        }
        
        if( $unit == "s" )
            return $t." s";
        else if( $unit == "min" )
            return round($t/60)." min";
        else if( $unit == "h" )
            return round($t/3600)." h";
        
    }
    
    

    public function getName()
    {
        return 'jng_extension';
    }
}
