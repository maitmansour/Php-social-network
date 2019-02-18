<?php
/*
*Classe des fonctions et utilités Chat
*AIT MANSOUR & BELGHARBI
*M1 ILSEN
*/
class chatTable{


    /*
    *Get All Chats
    *Created By BELGHARBI Meryem
    */
    public static function getChats() {
        $em = dbconnection::getInstance()->getEntityManager() ;
        $chatRepository = $em->getRepository('chat');
        $chats = $chatRepository->findAll();

        return $chats;

    }




    /*
    *Get Last Chat
    *Created By BELGHARBI Meryem
    */
    public static function getLastChat(){

        $em = dbconnection::getInstance()->getEntityManager() ;
        $result = $em->createQueryBuilder('a')
            -> select('a')
            ->from('chat','a')
            ->orderBy('a.id','DESC')
            ->setMaxResults(1)->getQuery()
            ->getOneOrNullResult();
        return  $result;

    }

    /*
    *Get next Chat
    *Created By BELGHARBI Meryem
    */
    public static function getNextChat($wanted_id)
    {
         $wanted_id=$wanted_id+1;
         $em = dbconnection::getInstance()->getEntityManager() ;
         $result = $em->createQueryBuilder('a')
            ->select('a')
            ->from('chat','a')
            ->where('a.id = :wanted_id')
            ->setParameter('wanted_id',$wanted_id)
            ->setMaxResults(1)->getQuery()
            ->getOneOrNullResult();
        return $result;
    }


    /*
    *save New Chat
    *Created By BELGHARBI Meryem
    */
    public static function saveNewChat($texte,$current_user)    
    {
        $utilisateur=utilisateurTable::getUserById($current_user); 
        $em = dbconnection::getInstance()->getEntityManager() ;
        $post=new post();
        $post->setTexte($texte);
        $post->setDate(new DateTime("now"));
        $em->persist($post);
        $em->flush();
        $chat = new chat();
        $chat->setPost($post);
        $chat->setEmetteur($utilisateur);
        $em->persist($chat);
        $em->flush();
    }



}

?>