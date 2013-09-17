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
     * @var integer
     */
    private $activity_id;

    /**
     * @var integer
     */
    private $task_id;

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
     * Set activity_id
     *
     * @param integer $activityId
     * @return ActivityStorage
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
     * Set task_id
     *
     * @param integer $taskId
     * @return ActivityStorage
     */
    public function setTaskId($taskId)
    {
        $this->task_id = $taskId;
    
        return $this;
    }

    /**
     * Get task_id
     *
     * @return integer 
     */
    public function getTaskId()
    {
        return $this->task_id;
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
}
