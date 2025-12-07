<?php require_once('../../admin/private/init.php'); ?>
<?php
    $response = new Response();
    $errors = new Errors();
    $send_mail = false;

    $pgUserId = "";
    if((isset($_POST["login_user_id"])) && (!empty($_POST["login_user_id"]))) {
        $pgUserId = $_POST["login_user_id"];
    } elseif((isset($_GET["login_user_id"])) && (!empty($_GET["login_user_id"]))) {
        $pgUserId = $_GET["login_user_id"];
    }

    if(Helper::is_post()){
        $api_token = Helper::post_val("api_token");
        if($api_token){
            $setting = new Setting();
            $setting = $setting->where(["api_token" => $api_token])->one();

            if(!empty($setting)){
               if(isset($pgUserId)){
                    $user = new User();                
                    $user = $user->where(["id" => $pgUserId])->one();
                    if(!empty($user)){
                        if((isset($user->signin_otp)) && (!empty($user->signin_otp))){
                            if($user->signin_otp == $_POST['signInOtp']){
                                $updated = new User();
                                $updated->signin_otp = $_POST['signInOtp'];
                                $updated->id = $pgUserId;
                                if($updated->where(["id"=>$updated->id])->update()) { 
                                    $response->create(200, "Logged In Successfully.", $updated->to_valid_array());
                                    $_SESSION['userId'] = $user->id;
                                    $_SESSION['userName'] = $user->username;
                                    $_SESSION['userImage'] = $user->image;
                                    $_SESSION['verificationToken'] = $user->verification_token;
                                    $_SESSION['mobile'] = $user->mobile;
                                } else { 
                                    $response->create(201, "Something Went Wrong. Try Again.", null);
                                }
                            }else $response->create(201, "Invalid Otp", null);
                        }
                    }else $response->create(201, "Invalid User", null);
                }else $response->create(201, "Invalid Parameter", null);
            }else $response->create(201, "Invalid Api Token", null);
        }else $response->create(201, "No Api Token Found", null);
    }else $response->create(201, "Invalid Request Method", null);

    if($send_mail){
        Helper::curl_mail_sender("send-code.php", $user->id, $setting->api_token);
    }

    echo $response->print_response();
?>
