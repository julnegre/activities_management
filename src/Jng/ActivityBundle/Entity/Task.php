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
     * @var \Jng\ActivityBundle\Entity\Activity
     */
    private $activity;


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
     * Set order_nb
     *
     * @param integer $orderNb
     * @return Task
     */
    public function setOrderNb($orderNb)
    {
        $this->order_nb = $orderNb;
    
        return $this;
    }

    /**
     * Get order_nb
     *
     * @return integer 
     */
    public function getOrderNb()
    {
        return $this->order_nb;
    }

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
