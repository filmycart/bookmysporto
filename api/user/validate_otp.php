<?php require_once('../../admin/private/init.php'); ?>
<?php
    $response = new Response();
    $errors = new Errors();
    $send_mail = false;

    $pgUserId = "";
    if((isset($_POST["user_id"])) && (!empty($_POST["user_id"]))) {
        $pgUserId = $_POST["user_id"];
    } elseif((isset($_GET["user_id"])) && (!empty($_GET["user_id"]))) {
        $pgUserId = $_GET["user_id"];
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
                            if((isset($user->otp)) && (!empty($user->otp))){
                                if($user->otp == $_POST['userOtp']){
                                    $updated = new User();
                                    $updated->status = 1;
                                    $updated->id = $pgUserId;
                                    if($updated->where(["id"=>$updated->id])->update()) $response->create(200, "User Mobile Number Verified Successfully", $updated->to_valid_array());
                                    else $response->create(201, "Something Went Wrong. Try Again.", null);
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
