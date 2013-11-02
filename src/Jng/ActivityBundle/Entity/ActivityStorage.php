<?php

namespace Jng\ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActivityStorage
 */
class ActivityStorage
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $start;

    /**
     * @var \DateTime
     */
    private $end;

    /**
     * @var \Jng\ActivityBundle\Entity\Activity
     */
    private $activity;

    /**
     * @var \Jng\ActivityBundle\Entity\Task
     */
    private $task;


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
     * Set start
     *
     * @param \DateTime $start
     * @return ActivityStorage
     */
    public function setStart($start)
    {
        $this->start = $start;
    
        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     * @return ActivityStorage
     */
    public function setEnd($end)
    {
        $this->end = $end;
    
        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime 
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set activity
     *
     * @param \Jng\ActivityBundle\Entity\Activity $activity
     * @return ActivityStorage
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

    /**
     * Set task
     *
     * @param \Jng\ActivityBundle\Entity\Task $task
     * @return ActivityStorage
     */
    public function setTask(\Jng\ActivityBundle\Entity\Task $task = null)
    {
        $this->task = $task;
    
        return $this;
    }

    /**
     * Get task
     *
     * @return \Jng\ActivityBundle\Entity\Task 
     */
    public function getTask()
    {
        return $this->task;
    }
    /**
     * @ORM\PrePersist
     */
    public function setStartValue()
    {
        $this->start = new \DateTime();
    }
    
    public function setEndValue()
    {
        $this->end = new \DateTime();
    }
    /**
     * @var \Jng\UserBundle\Entity\User
     */
    private $user;


    /**
     * Set user
     *
     * @param \Jng\UserBundle\Entity\User $user
     * @return ActivityStorage
     */
    public function setUser(\Jng\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Jng\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}