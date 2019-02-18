<?php
/*
 *Classe des fonctions et utilités utilisateur
 *AIT MANSOUR & BELGHARBI
 *M1 ILSEN
 */
class utilisateurTable
{
    
    
    /*
     *Get users By login & Password
     *Updated By AIT MANSOUR
     */
    public static function getUserByLoginAndPass($login, $pass)
    {
        $em = dbconnection::getInstance()->getEntityManager();

        $userRepository = $em->getRepository('utilisateur');
        $user           = $userRepository->findOneBy(array(
            'identifiant' => $login,
            'pass' => sha1($pass)
        ));
        return $user;
    }
    
    
    
    /*
     *Get One User By Id
     *Created By BELGHARBI
     */
    public static function getUserById($id)
    {
        $em             = dbconnection::getInstance()->getEntityManager();
        $userRepository = $em->getRepository('utilisateur');
        $user           = $userRepository->findOneBy(array(
            'id' => $id
        ));
        return $user;
    }   
    
    
    /*
     *Get One User By Id
     *Created By BELGHARBI
     */
    public static function getUsersByPattern($pattern)
    {
        $em             = dbconnection::getInstance()->getEntityManager();
        $userRepository = $em->getRepository('utilisateur');
         $users    = $em->createQueryBuilder()
        ->select('u')
        ->from('utilisateur', 'u')
        ->where("u.prenom LIKE :pattern")
        ->orWhere('u.nom LIKE :pattern')
        ->setParameter('pattern', '%'.$pattern.'%')   
        ->getQuery()
        ->getResult();
        return $users;
    }
    
    
    
    /*
     *Get All Users
     *Created By AIT MANSOUR Mohamed
     */
    public static function getUsers()
    {
        $em             = dbconnection::getInstance()->getEntityManager();
        $userRepository = $em->getRepository('utilisateur');
        $users          = $userRepository->findAll();
        return $users;
        
    }
    
    /*
     *Update user
     *Created By BELGHARBI
     */
    public static function updateUser($user_id,$new_value,$type)
    {
        $em             = dbconnection::getInstance()->getEntityManager();
        $newUser = utilisateurTable::getUserById($user_id);
        switch ($type) {
            case 1:
        $newUser->setStatut($new_value);
                break;            
            case 2:
        $newUser->setAvatar($new_value);
                break;
        }
        $em->persist($newUser);
        $em->flush();      
    }
}

?>