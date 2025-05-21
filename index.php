<?php
    include("config/env.php");

    $pgName = "";
    if((isset($_GET['pg-nm'])) && (!empty($_GET['pg-nm']))){
        $pgName = $_GET['pg-nm'];
    }

/*    echo $pgName;
    exit;
*/
    $templateName = 'dreamsports';
    if((isset($config['frontend']['template'])) && (!empty($config['frontend']['template']))) {
        $templateName = $config['frontend']['template'];  
    }

    switch ($pgName) {
      case 'home':
        include_once('frontend/'.$templateName.'/home.php');
        break;
      case 'about':
        include_once('frontend/'.$templateName.'/about-us.php');
        break;  
      case 'login':
        include_once('frontend/'.$templateName.'/login.php');
        break;  
      case 'register':
        include_once('frontend/'.$templateName.'/register.php');
        break;
      case 'contact':
        include_once('frontend/'.$templateName.'/contact.php');
        break;
      case 'logout':
        include_once('frontendapi/'.$templateName.'/logout.php');
        break; 
      case 'send-sms':
        include_once('frontendapi/'.$templateName.'/send-sms.php');
        break;        
      default:
        include_once('frontend/'.$templateName.'/home.php');
    }
?>