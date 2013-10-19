<?php

namespace Jng\ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 */
class Task
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
    private $order_nb;


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
     * @return Task
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
     * Set order
     *
     * @param integer $order
     * @return Task
     */
    public function setOrderNb($order)
    {
        $this->order_nb = $order;
    
        return $this;
    }

    /**
     * Get order
     *
     * @return integer 
     */
    public function getOrderNb()
    {
        return $this->order_nb;
    }
    
    public function __toString()
    {
        return strval($this->id);
    }
    
    
    /**
     * @var \Jng\ActivityBundle\Entity\Activity
     */
    private $activity;


    /**
     * Set activity
     *
     * @param \Jng\ActivityBundle\Entity\Activity $activity
     * @return Task
     */
    public function setActivity(\Jng\ActivityBundle\Entity\Activity $activity = null)
    {
        $this->activity = $activity;
    
        return $this;
    }

    /**
     * Get activity
     *
     * @return \Jng\ActivityBundle\Entity\Activity 
     */
    public function getActivity()
    {
        return $this->activity;
    }
}