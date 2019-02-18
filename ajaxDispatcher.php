<?php
/**
*AIT MANSOUR Mohamed et BELGHARBI Meryem, modifié durant tout le développement
*/
   //nom de l'application
   $nameApp = "ceriLand";
   
   // Inclusion des classes et librairies
   require_once 'lib/core.php';
   require_once $nameApp.'/controller/mainController.php';
   
   session_start();
   
   $context = context::getInstance();
   $context->init($nameApp);
   $context->unavailable_picture_path="images/unavailable.png";
   
   if (empty($context->getSessionAttribute('last_action'))) {
         $action="ajaxError";
   }else{
          $context->user=$context->getSessionAttribute('user');
          $action = key_exists("action", $_REQUEST)?$_REQUEST['action']:"index";
   }
   
   $view=$context->executeAction($action, $_REQUEST);
   
   
   if($view==context::NONE){
   	$ajax_view=$nameApp."/view/shared/ajax.php";
   	include($ajax_view);
   
   }
   
   ?>