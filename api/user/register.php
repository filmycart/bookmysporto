<?php require_once('../../admin/private/init.php'); ?>
<?php

$response = new Response();
$errors = new Errors();
$send_mail = false;

if(Helper::is_post()){
    $api_token = Helper::post_val("api_token");
    if($api_token){
        $setting = new Setting();
        $setting = $setting->where(["api_token" => $api_token])->one();

        if(!empty($setting)) {
            if(isset($_POST["userName"]) && isset($_POST["userPhoneNumber"]) && isset($_POST["userType"])) {
                $user = new User();
                $user->mobile = Helper::post_val("userPhoneNumber");
                $user->username = Helper::post_val("userPhoneNumber");
                $user->name = Helper::post_val("userName");
                $user->type = Helper::post_val("userType");
                $user->is_coach = Helper::post_val("isCoach");

                if($user->type == NUMBER_USER){
                    $user->validate_with(["mobile", "username"]);
                    $errors = $user->get_errors();
                    if($errors->is_empty()){
                        $user_from_db = $user->where(["mobile" => $user->mobile])->one();
                        if(empty($user_from_db)){
							$user->status = 1;
                            $user->id = $user->save();
                            if(!empty($user->id)) {

                                /*$curl = curl_init();
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
                                
                                echo $smsresponse;
                                exit;
                                */

                                /*
                                    https://www.fast2sms.com/dev/bulkV2?authorization=XTtWLw39b8qZckUH7gSmRAKMYuGle5zNDpaxfni16PrCF4hQV2jS6nFwyQHgZ5mr2oCcKW3xP1BbXNiR&route=q&message=test123&flash=0&numbers=&schedule_time=
                                */

                                /*$curl = curl_init();

                                curl_setopt_array($curl, array(
                                  CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=XTtWLw39b8qZckUH7gSmRAKMYuGle5zNDpaxfni16PrCF4hQV2jS6nFwyQHgZ5mr2oCcKW3xP1BbXNiR&sender_id=DLT_SENDER_ID&message=".urlencode('test123')."&variables_values=".urlencode('12345|asdaswdx')."&route=dlt&numbers=".urlencode('9999999999,8888888888,7777777777'),
                                  CURLOPT_RETURNTRANSFER => true,
                                  CURLOPT_ENCODING => "",
                                  CURLOPT_MAXREDIRS => 10,
                                  CURLOPT_TIMEOUT => 30,
                                  CURLOPT_SSL_VERIFYHOST => 0,
                                  CURLOPT_SSL_VERIFYPEER => 0,
                                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                  CURLOPT_CUSTOMREQUEST => "GET",
                                  CURLOPT_HTTPHEADER => array(
                                    "cache-control: no-cache"
                                  ),
                                ));

                                $response = curl_exec($curl);
                                $err = curl_error($curl);

                                curl_close($curl);

                                if ($err) {
                                  echo "cURL Error #:" . $err;
                                } else {
                                  echo $response;
                                }*/

                                /*$curl = curl_init();
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
                                CURLOPT_POSTFIELDS => '{"messages":[{"destinations":[{"to":"'.$user->mobile.'"}],"from":"8105460391","text":"'.$user->verification_token.'"}]}',
                                CURLOPT_HTTPHEADER => array(
                                    'Authorization: App ffb5ace6504e414f5c52c6f4576627ff-e7563b89-22e9-4ebd-8731-6cf7e0ee9ad1',
                                    'Content-Type: application/json',
                                    'Accept: application/json'
                                 ),
                                ));
                                $smsresponse = curl_exec($curl);
                                curl_close($curl);
                                //echo $smsresponse;*/

                                $response->create(200, "Mobile Number Registered Successfully.", $user->response()->to_valid_array());

                            }else $response->create(201, "Something Went Wrong", null);
                        }else{
                            $response->create(201, "Mobile Number ". $user_from_db->mobile." Already Registered.",'');
                            /* if($user->where(["id"=>$user_from_db->id])->update()){
                                $user->id = $user_from_db->id;
                                $response->create(200, "Success", $user_from_db->response()->to_valid_array());
                            }else $response->create(201, "Something Went Wrong", null);*/
                        }
                    }else $response->create(201, $errors->get_error_str(), null);
                } else if($user->type == EMAIL_USER){
                    /*EMAIL LOGIN*/
                    $user->validate_with(["email", "password", "username"]);
                    $errors = $user->get_errors();
                    if($errors->is_empty()){

                        $user_from_db = $user->where(["email" => $user->email])->one();
                        if(empty($user_from_db)){
                            /*if(isset($_FILES["image"])) {
                                $uploaded_image = $_FILES["image"];
                                $upload = new Upload($uploaded_image);
                                $upload->set_max_size(MAX_IMAGE_SIZE);
                                if ($upload->upload()) {
                                    $user->image_name = $upload->get_file_name();
                                    $user->image_resolution = $upload->resolution;
                                }
                            }else{
                                $user->image_name = PROFILE_DEFAULT;
                                $user->image_resolution = DEFAULT_RESOLUTION;
                            }*/
		
                            $user->id = $user->save();
                            if(!empty($user->id)){

                                $response->create(200, "Success", $user->response()->to_valid_array());
                                $send_mail = true;
								$mailer = new Mailer($user);
                                if(!$mailer->send()) $response->create(201, "Something Went Wrong", null);

                            }else $response->create(201, "Something Went Wrong", null);
                        }else if($user_from_db->status != 1){
							
							
                            if($user->where(["id"=>$user_from_db->id])->update()){
                                $user->id = $user_from_db->id;

                                $response->create(200, "Success", $user_from_db->response()->to_valid_array());
                                $send_mail = true;
								$mailer = new Mailer($user);
                                if(!$mailer->send()) $response->create(201, "Something Went Wrong", null);

                            }else $response->create(201, "Something Went Wrong", null);

                        }else if($user_from_db->status == 1) $response->create(201, "You Already Have an Account", null);
                    }else $response->create(201, $errors->get_error_str(), null);
                }else if(($user->type == APPLE_USER) || ($user->type == FACEBOOK_USER) || ($user->type == GOOGLE_USER)) {                    
                    /*SOCIAL LOGIN*/
                    $user->validate_with(["social_id"]);
                    $errors = $user->get_errors();
                    
                    if($errors->is_empty()){
                        $existing_user = $user->where(["type" => $user->type])->andWhere(["social_id" => $user->social_id])->one();
                        if(!empty($existing_user)){
                            $existing_user->verification_token = "";
							
							$cart_count = new Cart();
							$cart_count = $cart_count->where(["user_id" => $existing_user->id])->count();
									
							$response_user = $existing_user->to_valid_array();
							$response_user["cart_count"] = $cart_count;
							
                            $response->create(200, "Success", $response_user);
                        }else{

                            $user->image_name = Helper::post_val("image_name");
                            $user->id = $user->save();
                            if(!empty($user->id)){
								
								$cart_count = new Cart();
								$cart_count = $cart_count->where(["user_id" => $user->id])->count();
									
								$response_user = $user->to_valid_array();
								$response_user["cart_count"] = $cart_count;
                                $response->create(200, "Success", $response_user);
								
                            }else $response->create(201, "Something Went Wrong", null);
                        }
                    }else $response->create(201, $errors, null);
                }else $response->create(201, "Invalid User Type", null);
            }else $response->create(201, "Invalid Parameter", null);
        }else $response->create(201, "Invalid Api Token", null);
    }else $response->create(201, "No Api Token Found", null);
}else $response->create(201, "Invalid Request Method", null);


// if($send_mail){
    // Helper::curl_mail_sender("register.php", $user->id, $setting->api_token);
// }

echo $response->print_response();

?>
