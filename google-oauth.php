                                         zcHNs1th3400[5-<?php
	// Initialize the session
	session_start();
	// Update the following variables
	$google_oauth_client_id = '721747103744-26pe0qorikhrrkcs9kmjpgfn5q54sdbf.apps.googleusercontent.com';
	$google_oauth_client_secret = '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';
	$google_oauth_redirect_uri = 'https://dev.sportify.filmycart.in/google-oauth.php/google';
	$google_oauth_version = 'v3';

	preg_match("/[^\/]+$/", "https://dev.sportify.filmycart.in/google-oauth.php/google", $matches);
	$pgCode = $matches[0];

/*	echo $pgCode; 
	exit;*/
	
	/*$last_word = $matches[0]; // test
	echo $last_word;
	exit;

	$pgCode = "";
    if((isset($_GET['code'])) && (!empty($_GET['code']))){
        $pgCode = $_GET['code'];
    }*/

    if($pgCode == "google") {
		// If the captured code param exists and is valid
		//if (isset($_GET['code']) && !empty($_GET['code'])) {
		    // Execute cURL request to retrieve the access token
		    $params = [
		        'code' => $pgCode,
		        'client_id' => $google_oauth_client_id,
		        'client_secret' => $google_oauth_client_secret,
		        'redirect_uri' => $google_oauth_redirect_uri,
		        'grant_type' => 'authorization_code'
		    ];
		    $ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL, 'https://accounts.google.com/o/oauth2/token');
		    curl_setopt($ch, CURLOPT_POST, true);
		    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    $response = curl_exec($ch);
		    curl_close($ch);
		    $response = json_decode($response, true);
		    // Code goes here...
		//} else {
		    // Define params and redirect to Google Authentication page
		    /*$params = [
		        'response_type' => 'code',
		        'client_id' => $google_oauth_client_id,
		        'redirect_uri' => $google_oauth_redirect_uri,
		        'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
		        'access_type' => 'offline',
		        'prompt' => 'consent'
		    ];
		    header('Location: https://accounts.google.com/o/oauth2/auth?' . http_build_query($params));
		    exit;*/
		//}
	} else {
		$params = [
	        'response_type' => 'code',
	        'client_id' => $google_oauth_client_id,
	        'redirect_uri' => $google_oauth_redirect_uri,
	        'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
	        'access_type' => 'offline',
	        'prompt' => 'consent'
	    ];
	    header('Location: https://accounts.google.com/o/oauth2/auth?' . http_build_query($params));
	    exit;
	} 
?>