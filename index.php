<?php
    include("config/env.php");

    $pgName = "";
    if((isset($_GET['pg-nm'])) && (!empty($_GET['pg-nm']))){
        $pgName = $_GET['pg-nm'];
    }

    $config_admin_address = "";
    if((isset($config['config']['admin_address'])) && (!empty($config['config']['admin_address']))) {
        $config_admin_address = $config['config']['admin_address'];
    }

    $configArray = '';
    if((isset($config['config']['site_config'])) && (!empty($config['config']['site_config']))) {
        $configArray = $config['config']['site_config'];  
    }

    $frontendAssetUrl = '';
    if((isset($configArray['frontend_asset_url'])) && (!empty($configArray['frontend_asset_url']))) {
        $frontendAssetUrl = $configArray['frontend_asset_url'];  
    }

    $siteTitle = "";
    if((isset($configArray['title'])) && (!empty($configArray['title']))) {
        $siteTitle = $configArray['title'];
    }

    $siteKeyword = "";
    if((isset($configArray['keyword'])) && (!empty($configArray['keyword']))) {
        $siteKeyword = $configArray['keyword'];
    }

    $siteSubTitle = "";
    if((isset($configArray['sub_title'])) && (!empty($configArray['sub_title']))) {
        $siteSubTitle = $configArray['sub_title'];
    }

    $siteTagLine = "";
    if((isset($configArray['tag_line'])) && (!empty($configArray['tag_line']))) {
        $siteTagLine = $configArray['tag_line'];
    }

    $siteDescription = "";
    if((isset($configArray['description'])) && (!empty($configArray['description']))) {
        $siteDescription = $configArray['description'];
    }

    $templateName = 'dreamsports';
    if((isset($configArray['frontend_template'])) && (!empty($configArray['frontend_template']))) {
        $templateName = $configArray['frontend_template'];  
    }

    $siteAuthor = "";
    if((isset($configArray['author'])) && (!empty($configArray['author']))) {
        $siteAuthor = $configArray['author'];
    }

    $pgHomeActive = "";
    $pgCoachesActive = "";
    $pgAboutActive = "";
    $pgContactActive = "";
    $pgLoginActive = "";
    $pgRegisterActive = "";

    if(!empty($pgName)) {
      switch ($pgName) {
        case '':
          $pgHomeActive = 'class="active"';
          include_once('frontend/'.$templateName.'/home.php');
          break;
        case 'coach':
          $pgCoachesActive = 'class="active"';
          include_once('frontend/'.$templateName.'/coaches.php');
          break;
        case 'home':
          $pgHomeActive = 'class="active"';
          include_once('frontend/'.$templateName.'/home.php');
          break;  
        case 'about-us':
          $pgAboutActive = 'class="active"';
          include_once('frontend/'.$templateName.'/about-us.php');
          break;
        case 'privacy-policy':
          $pgPrivacyActive = 'class="active"';
          include_once('frontend/'.$templateName.'/privacy-policy.php');
          break;
        case 'terms-of-service':
          $pgTermsActive = 'class="active"';
          include_once('frontend/'.$templateName.'/terms-of-service.php');
          break;
        case 'login':
          $pgLoginActive = 'class="active"';
          include_once('frontend/'.$templateName.'/login.php');
          break;  
        case 'logout':
          header('Location: '.'api/user/login.php?pg-nm='.$pgName);
          break;
        case 'register':
          $pgRegisterActive = 'class="active"';
          include_once('frontend/'.$templateName.'/register.php');
          break;
        case 'contact-us':
          $pgContactActive = 'class="active"';
          include_once('frontend/'.$templateName.'/contact-us.php');
          break;
        case 'send-sms':
          include_once('frontendapi/'.$templateName.'/send-sms.php');
          break;        
        default:
          include_once('frontend/'.$templateName.'/home.php');
          $pgHomeActive = 'class="active"';
      }
    } else {
        $pgHomeActive = 'class="active"';
        include_once('frontend/'.$templateName.'/home.php');      
    }
?>