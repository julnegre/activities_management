<?php
namespace Jng\ActivityBundle\Entity\Repository;
 
use Doctrine\ORM\EntityRepository;

/**
 * Description of CustomerRepository
 *
 * @author julien
 */
class TaskRepository extends EntityRepository
{

    /**
     * 
     * 
     * @param type $user_id
     */
    public function getTasksForUser($user){
        
	$qb = $this->createQueryBuilder('a');
 
        $qb->where('a.user = :user')
                  ->setParameter('user', $user);

        return $qb;
    }
    
    
}
