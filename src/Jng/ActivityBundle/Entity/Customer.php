<?php

namespace Jng\ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Customer
 */
class Customer
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Customer
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    
    public function __toString()
    {
        return strval($this->id);
    }
    
    /**
     * @var \Jng\ActivityBundle\Entity\Business
     */
    private $business;


    /**
     * Set business
     *
     * @param \Jng\ActivityBundle\Entity\Business $business
     * @return Customer
     */
    public function setBusiness(\Jng\ActivityBundle\Entity\Business $business = null)
    {
        $this->business = $business;
    
        return $this;
    }

    /**
     * Get business
     *
     * @return \Jng\ActivityBundle\Entity\Business 
     */
    public function getBusiness()
    {
        return $this->business;
    }
}