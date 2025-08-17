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

    $templateName = 'bookmysporto';
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
    $pgEventActive = "";

    if(!empty($pgName)) {
      switch ($pgName) {
        case '':
          $pgHomeActive = 'class="active"';
          include_once('frontend/'.$templateName.'/home.php');
          break;
        case 'coaches':
          $pgCoachesActive = 'class="active"';
          //include_once('frontend/'.$templateName.'/coaches.php');
          include_once('frontend/'.$templateName.'/coming-soon.php');
          break;
        case 'coach-details':
          $pgCoachesDetailsActive = 'class="active"';
          include_once('frontend/'.$templateName.'/coach-details.php');
          break;
        case 'venues':
          $pgCoachesActive = 'class="active"';
          //include_once('frontend/'.$templateName.'/venues.php');
          include_once('frontend/'.$templateName.'/coming-soon.php');
          break;    
        case 'venue-details':
          $pgVenueDetailsActive = 'class="active"';
          //include_once('frontend/'.$templateName.'/venue-details.php');
          include_once('frontend/'.$templateName.'/coming-soon.php');
          break; 
        case 'events':
          $pgEventActive = 'class="active"';
          include_once('frontend/'.$templateName.'/events.php');
          break;    
        case 'event-details':
          $pgEventActive = 'class="active"';
          include_once('frontend/'.$templateName.'/event-details.php');
          break;      
        case 'home':
          $pgHomeActive = 'class="active"';
          include_once('frontend/'.$templateName.'/home.php');
          break;  
        case 'my-booking':
          $pgHomeActive = 'class="active"';
          include_once('frontend/'.$templateName.'/my-booking.php');
          break;   
        case 'my-profile':
          $pgHomeActive = 'class="active"';
          include_once('frontend/'.$templateName.'/my-profile.php');
          break;
        case 'upd-profile':
          $pgHomeActive = 'class="active"';
          include_once('frontend/'.$templateName.'/update-profile.php');
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
          include('api/user/logout.php');
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