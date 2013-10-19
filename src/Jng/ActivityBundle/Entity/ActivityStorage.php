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
    
    
    public function setStartValue(){
        return $this->setStart(new \DateTime());
    }
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $activity;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $task;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->activity = new \Doctrine\Common\Collections\ArrayCollection();
        $this->task = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add activity
     *
     * @param \Jng\ActivityBundle\Entity\Activity $activity
     * @return ActivityStorage
     */
    public function addActivity(\Jng\ActivityBundle\Entity\Activity $activity)
    {
        $this->activity[] = $activity;
    
        return $this;
    }

    /**
     * Remove activity
     *
     * @param \Jng\ActivityBundle\Entity\Activity $activity
     */
    public function removeActivity(\Jng\ActivityBundle\Entity\Activity $activity)
    {
        $this->activity->removeElement($activity);
    }

    /**
     * Get activity
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Add task
     *
     * @param \Jng\ActivityBundle\Entity\Task $task
     * @return ActivityStorage
     */
    public function addTask(\Jng\ActivityBundle\Entity\Task $task)
    {
        $this->task[] = $task;
    
        return $this;
    }

    /**
     * Remove task
     *
     * @param \Jng\ActivityBundle\Entity\Task $task
     */
    public function removeTask(\Jng\ActivityBundle\Entity\Task $task)
    {
        $this->task->removeElement($task);
    }

    /**
     * Get task
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTask()
    {
        return $this->task;
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
}