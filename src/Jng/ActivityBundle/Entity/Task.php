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
    private $activity_id;

    /**
     * @var integer
     */
    private $order;


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
     * Set activity_id
     *
     * @param integer $activityId
     * @return Task
     */
    public function setActivityId($activityId)
    {
        $this->activity_id = $activityId;
    
        return $this;
    }

    /**
     * Get activity_id
     *
     * @return integer 
     */
    public function getActivityId()
    {
        return $this->activity_id;
    }

    /**
     * Set order
     *
     * @param integer $order
     * @return Task
     */
    public function setOrder($order)
    {
        $this->order = $order;
    
        return $this;
    }

    /**
     * Get order
     *
     * @return integer 
     */
    public function getOrder()
    {
        return $this->order;
    }
}
