<?php require_once('../../admin/private/init.php'); ?>
<?php
	$response = new Response();
	$errors = new Errors();

	if(Helper::is_post()){
	    $api_token = Helper::post_val("api_token");
	    if($api_token) {

	    	$curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.infobip.com/sms/2/text/advanced',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            //CURLOPT_POSTFIELDS =>'{"messages":[{"destinations":[{"to":"41793026727"}],"from":"InfoSMS","text":"This is a sample message"}]}',
            CURLOPT_POSTFIELDS => '{"messages":[{"destinations":[{"to":"9944063620"}],"from":"9944063620","text":"12345"}]}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: App ffb5ace6504e414f5c52c6f4576627ff-e7563b89-22e9-4ebd-8731-6cf7e0ee9ad1',
                'Content-Type: application/json',
                'Accept: application/json'
             ),
            ));
            $smsresponse = curl_exec($curl);
            curl_close($curl);
            
            /*echo $smsresponse;
            exit;*/

	    	/*$curl = curl_init();

			curl_setopt_array($curl, [
			  CURLOPT_URL => "https://rest-ww.telesign.com/v1/verify/reference_id",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => [
			    "accept: application/json",
			    "authorization: Basic MTc2QThGMEYtQjM1RC00QkIyLUFGMkQtMDYzOUM2REI2Q0MzOkgyL0luYnFpMk9IYzFMS081bnpyRnZ0clprMUtORFk5SGVzRUk4MW1Lem1UZ2Z6UHAzdlRaMVdGWFVnaEZ0RmxrczdTUGJnZ3EyRG5GcXYrSkdGYWNnPT0="
			  ],
			]);

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
			  echo $response;
			}
			exit;*/

			/*print"<pre>";
			print_r($_POST);
			exit;*/

	        $setting = new Setting();
	        $setting = $setting->where(["api_token" => $api_token])->one();

	        if(!empty($setting)){
	            if(isset($_POST["usr_phone_number"])) {

	                $user = new User();
	                $user->mobile = trim($_POST["usr_phone_number"]);
	                //$user->password = trim($_POST["password"]);

	                $user->validate_with(["usr_phone_number"]);
	                $errors = $user->get_errors();

	                if($errors->is_empty()){
						//if(strlen($user->mobile) > 10){
							$user = $user->verify_login_mobile();

							$_SESSION['userId'] = $user->id;
							$_SESSION['userName'] = $user->username;
							$_SESSION['verificationToken'] = $user->verification_token;
							$_SESSION['mobile'] = $user->mobile;

							$curl = curl_init();

							if(!empty($user)){
								if($user->status > 0){
									
									$cart_count = new Cart();
									$cart_count = $cart_count->where(["user_id" => $user->id])->count();
											
									$response_user = $user->response()->to_valid_array();
									$response_user["cart_count"] = $cart_count;

									//header('Location: '.$_SERVER['HTTP_ORIGIN'].'/sportify/');
									header('Location: '.$_SERVER['HTTP_ORIGIN']);
									exit;

									$response->create(200, "Successfully Signed In", $response_user);

								}else$response->create(201, "Please Verify Your Email", null);
							}else $response->create(201, "Invalid Email / Password", null);
							
						//}else $response->create(201, "Charater must be over 10 character.", null);
	                }else $response->create(201, $errors, null);
	            }else $response->create(201, "Invalid Parameter", null);
	        }else $response->create(201, "Invalid Api Token", null);
	    }else $response->create(201, "No Api Token Found", null);
	}else $response->create(201, "Invalid Request Method", null);

	echo $response->print_response();
?>
