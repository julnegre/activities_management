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
     * @var integer
     */
    private $business_id;


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

    /**
     * Set business_id
     *
     * @param integer $businessId
     * @return Customer
     */
    public function setBusinessId($businessId)
    {
        $this->business_id = $businessId;
    
        return $this;
    }

    /**
     * Get business_id
     *
     * @return integer 
     */
    public function getBusinessId()
    {
        return $this->business_id;
    }
}
