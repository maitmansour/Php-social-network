<?php 
/*
 *Classe des fonctions et utilités Post
 *AIT MANSOUR & BELGHARBI
 *M1 ILSEN
 */
class postTable {


/*
 *Get number of shares
 *AIT MANSOUR
 */
    public static function getSharesNumber($wanted_id)
    {
         $em = dbconnection::getInstance()->getEntityManager() ;
         $result = $em->createQueryBuilder('m')

         ->select('COUNT(m.id)')
            ->from('message','m')
            ->groupBy('m.post')
            ->having('m.post = :wanted_id')
            ->setParameter('wanted_id',$wanted_id)
            ->getQuery()
             ->getSingleScalarResult();

        return $result-1;
    }

}

?>