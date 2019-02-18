<?php

/**
*AIT MANSOUR Mohamed et BELGHARBI Meryem, modifié durant tout le développement
*/
   /**
    * Application name, used for URLs
    */
   $nameApp = "ceriLand";
   
   /**
    * Include controllers and libraries
    */
   require_once 'lib/core.php';
   require_once $nameApp.'/controller/mainController.php';
   session_start();
   
   /**
    * Singleton of context, save all information about database and other information
    */
   $context = context::getInstance();
   $context->init($nameApp);
   $context->unavailable_picture_path="images/unavailable.png";
   /**
    * Redirect into index page if user login, and to login page if not
    */
   if (empty($context->getSessionAttribute('last_action'))) {
                   $action="login";
   //&&$_REQUEST['action']!="logout")
   }else{
       $context->setSessionAttribute('last_action',time());
       $context->user=$context->getSessionAttribute('user');
          $action = key_exists("action", $_REQUEST)?$_REQUEST['action']:"index";
   }
   
   /**
    * get The action view
    */
   $view=$context->executeAction($action, $_REQUEST);
   
   /**
    * call view
    */
   if($view!=context::NONE){
   
       $header_view=$nameApp."/view/shared/header.php";
       $footer_view=$nameApp."/view/shared/footer.php";
           $notifications_view=$nameApp."/view/shared/notifications.php";
   
       if (empty($context->getSessionAttribute('user'))) {
           $template_view=$nameApp."/view/connexion/".$action.$view.".php";
           include($nameApp."/layout/".$context->getLayout()."Visitor.php");
   
       }else{
           if ($action=="login")$action="index";
   
           $friends_view=$nameApp."/view/shared/friends.php";
           $item_view=$nameApp."/view/shared/item.php";
           $navbar_view=$nameApp."/view/shared/navbar.php";
           $share_view=$nameApp."/view/shared/share.php";
           $sidebar_view=$nameApp."/view/shared/sidebar.php";
           $chat_view=$nameApp."/view/chat/chatBox.php";
           $template_view=$nameApp."/view/".$context->viewType."/".$action.$view.".php";
           include($nameApp."/layout/".$context->getLayout().".php");
   
       }
   
   
   }
   
   ?>