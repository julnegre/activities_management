<?php
namespace Jng\ActivityBundle\Entity\Repository;
 
use Doctrine\ORM\EntityRepository;

/**
 * Description of ActivityRepository
 *
 * @author julien
 */
class ActivityStorageRepository extends EntityRepository
{
    /**
     * 
     * 
     * @param type $user_id
     */
    public function getActivitiesForUser($user, $d1, $d2){
        
	$qb = $this->createQueryBuilder('a');
 
        $qb->where('a.user = :user and a.start BETWEEN :d1 AND :d2');
                  
        $qb->setParameter('user', $user)
            ->setParameter('d1', $d1)
            ->setParameter('d2', $d2);
        
        $qb->orderBy("a.start", "DESC");
        //return $qb;
        
        $query = $qb->getQuery();
 
        return $query->getResult();
        
    }
    
    
    
}
