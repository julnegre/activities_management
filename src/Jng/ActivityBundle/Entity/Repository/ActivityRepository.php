<?php
namespace Jng\ActivityBundle\Entity\Repository;
 
use Doctrine\ORM\EntityRepository;

/**
 * Description of ActivityRepository
 *
 * @author julien
 */
class ActivityRepository extends EntityRepository
{
    /**
     * 
     * 
     * @param type $user_id
     */
    public function getActivitiesForUser($user){
        
	$qb = $this->createQueryBuilder('a');
 
        $qb->where('a.user = :user')
                  ->setParameter('user', $user);

        return $qb;
    }
    
    
}
