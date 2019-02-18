<?php
/*
 *Classe des fonctions et utilités Message
 *AIT MANSOUR & BELGHARBI
 *M1 ILSEN
 */
class messageTable
{
    
    
    /*
     *Get All Messages By Id User
     *Created By AIT MANSOUR & BELGHARBI
     */
    public static function getMessageByUserId($id)
    {
        $em                = dbconnection::getInstance()->getEntityManager();
        $messageRepository = $em->getRepository('message');
        $user_messages     = $em->createQueryBuilder()
        ->select('m')
        ->from('message', 'm')
        ->where("m.emetteur = :id")
        ->orWhere("m.destinataire = :id")
        ->setParameter('id', $id)
        ->orderBy('m.id', 'DESC')
        ->getQuery()
        ->getResult();
        return $user_messages;
    }
    
    /*
     *Get All Messages
     *Created By AIT MANSOUR Mohamed
     */
    public static function getAllMessage()
    {
        $em                = dbconnection::getInstance()->getEntityManager();
        $messageRepository = $em->getRepository('message');
        $user_messages     = $em->createQueryBuilder()
        ->select('m')
        ->from('message', 'm')
        ->orderBy('m.id', 'DESC')
        ->setMaxResults(20)
        ->getQuery()
        ->getResult();
        return $user_messages;
    }    
    /*
     *Get All Messages
     *Created By AIT MANSOUR Mohamed
     */
    public static function getOneMessage($first)
    {
        $em                = dbconnection::getInstance()->getEntityManager();
        $messageRepository = $em->getRepository('message');
        $user_messages     = $em->createQueryBuilder()
        ->select('m')
        ->from('message', 'm')
        ->orderBy('m.id', 'DESC')
        ->where("m.id < :id")
        ->setParameter('id', $first)
        ->setMaxResults(10)
        ->getQuery()
        ->getResult();
        return $user_messages;
    }


    /*
     *Get last Inserted Message
     *Created By AIT MANSOUR Mohamed
     */
    public static function getLastInsertedMessage()
    {
        $em                = dbconnection::getInstance()->getEntityManager();
        $messageRepository = $em->getRepository('message');

        $user_messages     = $em->createQueryBuilder()
        ->select('m')
        ->from('message', 'm')
        ->orderBy('m.id', 'DESC')
        ->setMaxResults(1)
        ->getQuery()
        ->getResult();
        return $user_messages;
    }


    /*
     *Incerease Likes
     *Created By AIT MANSOUR Mohamed
     */
    public static function increaseLikes($message_id)
    {
        $em             = dbconnection::getInstance()->getEntityManager();
        $message = messageTable::getMessageById($message_id);
        $message->setAime($message->getAime()+1);
        $em->persist($message);
        $em->flush();      
    }


    /*
     *Get One Message By Id
     *Created By AIT MANSOUR Mohamed
     */
    public static function getMessageById($id)
    {
        $em             = dbconnection::getInstance()->getEntityManager();
        $messageRepository = $em->getRepository('message');
        $message           = $messageRepository->findOneBy(array(
            'id' => $id
        ));
        return $message;
    }   
    

    /*
     *save One Message 
     *Created By AIT MANSOUR Mohamed
     */
    public static function saveNewMessage($texte,$current_user,$tag,$img){

        $utilisateur=utilisateurTable::getUserById($current_user); 
        $tagged=utilisateurTable::getUserById($tag); 
        $em = dbconnection::getInstance()->getEntityManager() ;
        $post=new post();
        $post->setTexte($texte);
        $post->setImage($img);
        $post->setDate(new DateTime("now"));
        $em->persist($post);
        $em->flush();
        $message = new message();
        $message->setPost( $post);
        $message->setEmetteur($utilisateur);
        if (!is_null($tagged)) {
        $will_be_tagged=utilisateurTable::getUserById($tagged); 
            $message->setDestinataire($will_be_tagged);
        }
        $em->persist($message);
        $em->flush();

    }    


    /*
     *Share One Message 
     *Created By AIT MANSOUR Mohamed
     */
    public static function shareMessage($message_id,$current_user){

        $utilisateur=utilisateurTable::getUserById($current_user); 
        $message_old=self::getMessageById($message_id); 
        $parent=$message_old->getParent(); 
        $em = dbconnection::getInstance()->getEntityManager() ;
        $post=$message_old->getPost();
        $message = new message();
        $message->setPost( $post);
        $message->setEmetteur($utilisateur);
        $message->setParent($parent);
        $em->persist($message);
        $em->flush();

    }
}

?>