<?php
	require_once('./admin/private/init.php');

	$requestScheme = "";
	if((isset($_SERVER['REQUEST_SCHEME'])) && (!empty($_SERVER['REQUEST_SCHEME']))) {
		$requestScheme = $_SERVER['REQUEST_SCHEME'];	
	}

	$hostName = "";
	if((isset($_SERVER['HTTP_HOST'])) && (!empty($_SERVER['HTTP_HOST']))) {
		$hostName = $_SERVER['HTTP_HOST'];	
	}

	$baseUrl = "";
	$settingsUrl = "";
	if($hostName == "localhost") {
		$baseUrl = "://localhost/sportifyv2/";
		$settingsUrl = $requestScheme.$baseUrl.'api/settings/setting.php';
	} else {
		$baseUrl = "://bookmysporto.com/";
		$settingsUrl = $requestScheme.$baseUrl.'api/settings/setting.php';
	}

	$eventImagePath = $requestScheme.$baseUrl."admin/uploads/events/";
	$eventNoImage = $requestScheme.$baseUrl."admin/assets/images/event-01.jpg";

	$adminImageUploadPath = "uploads/";
	$eventAdminImageUploadPath = $adminImageUploadPath."events/"; 
	$eventSubCatAdminImageUploadPath = $adminImageUploadPath."event_subcategory/"; 
	$eventFrontEndImageUploadPath = "././admin/".$adminImageUploadPath."events/"; 
	
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => $settingsUrl,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS => array('api_token' => '123456789'),
	  CURLOPT_HTTPHEADER => array(
	    'Cookie: PHPSESSID=u3igrqn5stlv226gqh17mokl9s'
	  ),
	));

	$configResponse = curl_exec($curl);

	curl_close($curl);
	
	$configResponseArray = array();
	if(!empty($configResponse)) {
		$configResponseArray = (array)json_decode($configResponse);
	}

	$admin_address = "";
	if((isset($configResponseArray['data']->admin_address)) && (!empty($configResponseArray['data']->admin_address))) {
		$admin_address = $configResponseArray['data']->admin_address;
	}

	$siteConfig = new Site_Config();
    $siteConfig = $siteConfig->where(["admin_id" => 1])->one();

	$siteConfigArray = array();
	if((isset($siteConfig->id)) && (!empty($siteConfig->id))) {
        $siteConfigArray['id'] = $siteConfig->id;  
    }

    if((isset($siteConfig->image_name)) && (!empty($siteConfig->image_name))) {
        $siteConfigArray['image_name'] = $siteConfig->image_name;  
    }

    if((isset($siteConfig->title)) && (!empty($siteConfig->title))) {
        $siteConfigArray['title'] = $siteConfig->title;  
    }

	if((isset($siteConfig->keyword)) && (!empty($siteConfig->keyword))) {
        $siteConfigArray['keyword'] = $siteConfig->keyword;  
    }    

    if((isset($siteConfig->sub_title)) && (!empty($siteConfig->sub_title))) {
        $siteConfigArray['sub_title'] = $siteConfig->sub_title;  
    }

    if((isset($siteConfig->tag_line)) && (!empty($siteConfig->tag_line))) {
        $siteConfigArray['tag_line'] = $siteConfig->tag_line;  
    }

    if((isset($siteConfig->description)) && (!empty($siteConfig->description))) {
        $siteConfigArray['description'] = $siteConfig->description;  
    }

    if((isset($siteConfig->firebase_auth)) && (!empty($siteConfig->firebase_auth))) {
        $siteConfigArray['firebase_auth'] = $siteConfig->firebase_auth;  
    }

    if((isset($siteConfig->admin_id)) && (!empty($siteConfig->admin_id))) {
        $siteConfigArray['admin_id'] = $siteConfig->admin_id;  
    }

    if((isset($siteConfig->author)) && (!empty($siteConfig->author))) {
        $siteConfigArray['author'] = $siteConfig->author;  
    }

    if((isset($siteConfig->favicon_image_name)) && (!empty($siteConfig->favicon_image_name))) {
        $siteConfigArray['favicon_image_name'] = $siteConfig->favicon_image_name;  
    }

    if((isset($siteConfig->frontend_template)) && (!empty($siteConfig->frontend_template))) {
        $siteConfigArray['frontend_template'] = $siteConfig->frontend_template;  
    }

    if((isset($siteConfig->frontend_asset_url)) && (!empty($siteConfig->frontend_asset_url))) {
        $siteConfigArray['frontend_asset_url'] = $siteConfig->frontend_asset_url;  
    }

	$config = [
	    'config' => [
	        'admin_address' => $admin_address,
	        'site_config' => $siteConfigArray
	        //'state' => $stateResponseArr
	    ],
	    'db' => [
	        'connection' => [
	            'default' => [
	                'host' => 'localhost',
	                'dbname' => 'shopifyv2',
	                'username' => 'root',
	                'password' => 'Nachiyar*1984'
	            ]
	        ]
	    ]
	];
