<?php
/*
 *Main Controller
 *AIT MANSOUR & BELGHARBI
 *M1 ILSEN
 */
class mainController
{


    /**
     * Show the index page  by AIT MANSOUR MOhamed 
     * @param $request
     * @param $context
     * @return mixed
     */
    public static function index($request, $context)
    {
        $context->messages         = messageTable::getAllMessage();
        $context->viewType="shared";
        return context::SUCCESS;
    }

    /**
     * Login to the website using username and password by AIT MANSOUR MOhamed 
     * @param $request
     * @param $context
     * @return mixed
     */
    public static function login($request, $context)
    {
        if (isset($_POST['login'])) {
            $user = utilisateurTable::getUserByLoginAndPass($_POST['login'], $_POST['password']);
            $context->user=$user;
            if (!$user) {
                $context->notification     = "Error on Login/Password";
                $context->notificationType = "danger";
                $context->viewType="connexion";
            } else {
            	if (is_null($user->getAvatar()))$user->setAvatar($context->unavailable_picture_path);
                $context->setSessionAttribute('user', $user);
                $context->setSessionAttribute('last_action', time());
                $context->notification     = "Connected successfuly";
                $context->notificationType = "success";
                $context->viewType="shared";
                self::index($request,$context);

            }
        }
        return context::SUCCESS;
    }


    /**
     * Logout and delete all information about user by AIT MANSOUR MOhamed 
     * @param $request
     * @param $context
     * @return mixed
     */
    public static function logout($request, $context)
    {
        $context->viewType="connexion";
        unset($_SESSION['user']);
        unset($_SESSION['last_action']);
                        $context->notification     = "Logged out successfuly";
                $context->notificationType = "success";
        return context::SUCCESS;
    }



    /**
     * Return All Users for AutoComplet by BELGHARBI Meryem
     * @param $request
     * @param $context
     * @return mixed
     */
    public static function users($request, $context)
    {
      if (isset($_GET['pattern'])) {
        $pattern = htmlspecialchars($_GET['pattern']);
        $all_users         = utilisateurTable::getUsersByPattern($pattern);
        if (!is_null($all_users)) {
           $i=0;

        foreach ($all_users as $key => $value) {
          $users[$i]['id']=$value->getId();
          $users[$i]['value']=$value->getPrenom()." ".$value->getNom();
          $i++;
        }
        $context->result=json_encode($users);
        }
       
      }
        
        return context::NONE;
    }

    /**
     * get Last Chat Messages by   BELGHARBI Meryem
     * @param $request
     * @param $context
     * @return mixed
     */
    public static function getLastChat($request, $context)
    {
        //$id_last_chat=isset($_GET['id'])?$_GET['id']:0;
        $id_last_chat=isset($_POST['id'])?$_POST['id']:0;
        $id_last_chat=(int)$id_last_chat;

        if ($id_last_chat==0) {
            $chat = chatTable::getLastChat();
        }else{
            $chat = chatTable::getNextChat($id_last_chat);
        }
       if (!is_null($chat)) {

                $firstChat['ok']=1;
                $firstChat['id']=$chat->getId();
                $firstChat['text']=$chat->getPost()->getTexte();
                $firstChat['sender_id']=$chat->getEmetteur()->getId();
                $firstChat['sender_name']=$chat->getEmetteur()->getPrenom();
                $firstChat['sender_avatar']=$chat->getEmetteur()->getAvatar();
                if (is_null($chat->getEmetteur()->getAvatar()))$firstChat['sender_avatar']=$context->unavailable_picture_path;
                $firstChat['chat_time']=$chat->getPost()->getHour();
       }else{
        $firstChat['id']=$id_last_chat;
        $firstChat['ok']=0;
       }

       	$context->result = json_encode($firstChat);
        return context::NONE;
    }

    /**
     * Add New Chat Messages by  BELGHARBI Meryem
     * @param $request
     * @param $context
     * @return mixed
     */
    public static function newChatMessage($request, $context)
    {
       
                if(!empty($_POST['message'])){
                
                    //escape special characters
                    $texte = htmlentities($_POST['message']); 
                    chatTable::saveNewChat($texte,$context->user->getId());
                  //  $result = chatTable::saveNewChat($context->getSessionAttribute('user')->getId(),$id_post);
                        $context->result= "succes : chat message sent successfuly ";
                }else{
                 }

     return context::NONE;

 }    
    /**
     * Add New message by AIT MANSOUR MOhamed  
     * @param $request
     * @param $context
     * @return mixed
     */
    public static function newMessage($request, $context)
    {
       
                if(!empty($_POST['message_txt'])){
                                      $texte = strip_tags($_POST['message_txt']); 
                                      $tag=  isset($_POST['message_tag'])?$_POST['message_tag']:"";
                                      $img=  isset($_POST['message_img'])?$_POST['message_img']:"";
                                      $tag = strip_tags($tag); 
                                      $img = strip_tags($img); 

                    messageTable::saveNewMessage($texte,$context->user->getId(),$tag,$img);
                  $message = messageTable::getLastInsertedMessage();
                  $message = $message[0];
                if (is_null($message->getEmetteur()->getAvatar()))$firstMessage['sender_avatar']=$context->unavailable_picture_path;
                    //escape special characters
                $firstMessage['ok']=1;
                $firstMessage['id']=$message->getId();
                $firstMessage['likes']=$message->getAime();
                $firstMessage['likes']=$firstMessage['likes']==null?0:$firstMessage['likes'];
                $firstMessage['shares']=postTable::getSharesNumber($message->getPost()->getId());
                $firstMessage['to_id']=$message->getDestinataire()->getId();
                $firstMessage['to_name']=$message->getDestinataire()->getPrenom()." ".$message->getDestinataire()->getNom();
                $firstMessage['text']=strip_tags($message->getPost()->getTexte());
                $firstMessage['image']=$message->getPost()->getImage();
                $firstMessage['date']=$message->getPost()->getDate();
                $firstMessage['hour']=$message->getPost()->getHour();
                $message_date=$message->getPost()->getDate()." ".$message->getPost()->getHour();
                $date = new DateTime($message->getPost()->getDate()." ".$message->getPost()->getHour());  
                $date = $date->format('Y-m-d H:i:s');
                $firstMessage['time_ago']=self::timeAgo($date);
                $firstMessage['sender_id']=$message->getEmetteur()->getId();
                $firstMessage['sender_name']=$message->getEmetteur()->getPrenom()." ".$message->getEmetteur()->getNom();
                $firstMessage['sender_avatar']=$message->getEmetteur()->getAvatar();

                     $context->result = json_encode($firstMessage);
                }else{
                 }

     return context::NONE;

 }    



    /**
     * Load Profile Data by AIT MANSOUR MOhamed  
     * @param $request
     * @param $context
     * @return mixed
     */
    public static function profile($request, $context)
    {
        if (isset($_GET['id'])) {
            $id_user=(int)$_GET['id'];
        }else{
            $id_user=$context->user->getId();
        }
        if ($id_user!=$context->user->getId()) {
            $context->userProfile=utilisateurTable::getUserById($id_user);
            if ($context->userProfile->getAvatar()==null)$context->userProfile->setAvatar($context->unavailable_picture_path);
            $context->showOthersProfile=1;
        }else{
       $context->userProfile=$context->user;
        }
            $context->messages         = messageTable::getMessageByUserId($id_user);

       $context->users=utilisateurTable::getUsersByPattern("");
       $context->viewType="pages/profile";
       return context::SUCCESS;
 } 


    /**
     * Show Ajax Error by AIT MANSOUR MOhamed  BELGHARBI Meryem
     * @param $request
     * @param $context
     * @return mixed
     */
    public static function ajaxError($request, $context)
    {
       $context->result="Error : User non logged in";
       return context::SUCCESS;
 } 


    /**
     * Update User informations by   BELGHARBI Meryem
     * @param $request
     * @param $context
     * @return mixed
     */
    public static function updateUser($request, $context)
    {
        $new_value=htmlentities($_POST['info']);
       switch ($_POST['type']) {
           case 'statut':
               $context->user->setStatut($new_value);
                    utilisateurTable::updateUser($context->user->getId(),$new_value,1);
               break;
           case 'avatar':
               $context->user->setAvatar($new_value);
                    utilisateurTable::updateUser($context->user->getId(),$new_value,2);
               break;
       }
       $context->result="success";
     return context::NONE;

 }



    /**
     * Update Message Likes Number by AIT MANSOUR MOhamed 
     * @param $request
     * @param $context
     * @return mixed
     */
    public static function AddLike($request, $context)
    {
        $new_value=htmlentities($_GET['id']);
         messageTable::increaseLikes($new_value);
     return context::NONE;

 }



    /**
     * Share Message by AIT MANSOUR MOhamed 
     * @param $request
     * @param $context
     * @return mixed
     */
    public static function ShareMessage($request, $context)
    {
        $new_value=htmlentities($_GET['id']);
        messageTable::shareMessage($new_value,$context->user->getId());
        $message = messageTable::getMessageById($new_value);
        $context->result=postTable::getSharesNumber($message->getPost()->getId());
     return context::NONE;

 }


     /**
     * get More Messages  by AIT MANSOUR MOhamed 
     * @param $request
     * @param $context
     * @return mixed
     */
    public static function loadMoreMessages($request, $context)
    {
        //$id_last_chat=isset($_GET['id'])?$_GET['id']:0;
        $id_last_message=isset($_GET['first'])?$_GET['first']:0;
        if ($id_last_message==0) {
            $messages = messageTable::getOneMessage(0);
        }else{
            $messages = messageTable::getOneMessage($id_last_message);
        }
       if (isset($messages[0])) {
       	$i=0;
        foreach ($messages as $message) {
              if (is_null($message->getEmetteur())||is_null($message->getPost())) {
                  continue;
                }
                $firstMessage[$i]['ok']=1;
                $firstMessage[$i]['id']=$message->getId();
                if (is_null($message->getParent())&&!is_null($message->getDestinataire())) {
                $firstMessage[$i]['to_id']=$message->getDestinataire()->getId();
                $firstMessage[$i]['to_name']=$message->getDestinataire()->getPrenom()." ".$message->getDestinataire()->getNom();
                                }


                if (!is_null($message->getParent())) {

                $firstMessage[$i]['via_id']=$message->getParent()->getId();
                $firstMessage[$i]['via_name']=$message->getParent()->getPrenom()." ".$message->getParent()->getNom();
                                }

                $firstMessage[$i]['text']=strip_tags($message->getPost()->getTexte());
                $firstMessage[$i]['image']=$message->getPost()->getImage();
                $firstMessage[$i]['date']=$message->getPost()->getDate();
                $firstMessage[$i]['likes']=$message->getAime();
                $firstMessage[$i]['likes']=$firstMessage[$i]['likes']==null?0:$firstMessage[$i]['likes'];
                $firstMessage[$i]['shares']=postTable::getSharesNumber($message->getPost()->getId());
                $firstMessage[$i]['hour']=$message->getPost()->getHour();
                $message_date=$message->getPost()->getDate()." ".$message->getPost()->getHour();
                $date = new DateTime($message->getPost()->getDate()." ".$message->getPost()->getHour());  
                $date = $date->format('Y-m-d H:i:s');
                $firstMessage[$i]['time_ago']=self::timeAgo($date);
                $firstMessage[$i]['sender_id']=$message->getEmetteur()->getId();
                $firstMessage[$i]['sender_name']=$message->getEmetteur()->getPrenom()." ".$message->getEmetteur()->getNom();
                $firstMessage[$i]['sender_avatar']=$message->getEmetteur()->getAvatar();
                if (!filter_var($firstMessage[$i]['sender_avatar'], FILTER_VALIDATE_URL)) {
                  $firstMessage[$i]['sender_avatar'] =$context->unavailable_picture_path;
                }
                if (is_null($message->getEmetteur()->getAvatar()))$firstMessage[$i]['sender_avatar']=$context->unavailable_picture_path;
                $i++;
        }
                     $context->result = json_encode($firstMessage);
  
       }

        return context::NONE;
    }    


     /**
     * return page AIT MANSOUR MOhamed 
     * @param $request
     * @param $context
     * @return mixed
     */
    public static function disclaimer($request, $context)
    {
        $context->viewType="pages/disclaimer";
        return context::SUCCESS;
    }


     /**
     * get friends AIT MANSOUR MOhamed 
     * @param $request
     * @param $context
     * @return mixed
     */
    public static function friends($request, $context)
    {
       $context->users=utilisateurTable::getUsersByPattern("");
        $context->viewType="pages/friends";
        return context::SUCCESS;
    }


     /**
     * additionnal / calculate time ago
     * @param $request
     * @param $context
     * @return mixed
     */
     public static function timeAgo($time_ago)
   {
   
       $time_ago = strtotime($time_ago);
   
       $cur_time   = time();
       $time_elapsed   = $cur_time - $time_ago;
       $seconds    = $time_elapsed ;
       $minutes    = round($time_elapsed / 60 );
       $hours      = round($time_elapsed / 3600);
       $days       = round($time_elapsed / 86400 );
       $weeks      = round($time_elapsed / 604800);
       $months     = round($time_elapsed / 2600640 );
       $years      = round($time_elapsed / 31207680 );
       // Seconds
       if($seconds <= 60){
           return "just now";
       }
       //Minutes
       else if($minutes <=60){
           if($minutes==1){
               return "one minute ago";
           }
           else{
               return "$minutes minutes ago";
           }
       }
       //Hours
       else if($hours <=24){
           if($hours==1){
               return "an hour ago";
           }else{
               return "$hours hrs ago";
           }
       }
       //Days
       else if($days <= 7){
           if($days==1){
               return "yesterday";
           }else{
               return "$days days ago";
           }
       }
       //Weeks
       else if($weeks <= 4.3){
           if($weeks==1){
               return "a week ago";
           }else{
               return "$weeks weeks ago";
           }
       }
       //Months
       else if($months <=12){
           if($months==1){
               return "a month ago";
           }else{
               return "$months months ago";
           }
       }
       //Years
       else{
           if($years==1){
               return "one year ago";
           }else{
               return "$years years ago";
           }
       }
   } 


    
}
