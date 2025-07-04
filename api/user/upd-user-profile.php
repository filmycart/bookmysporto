<?php require_once('../../admin/private/init.php'); ?>
<?php
$response = new Response();
$errors = new Errors();

if(Helper::is_post()) {
    $api_token = Helper::post_val("api_token");
    if($api_token){
        $setting = new Setting();
        $setting = $setting->where(["api_token" => $api_token])->one();

        if(!empty($setting)) {
            $user_id = Helper::post_val("profilePhone");
            $userImage = Helper::post_val("userImageHidden2");

            if($user_id) {
                $user = new User();
                $user = $user->where(["username"=>$user_id])->one();

                if(!empty($userImage)){
                    $user->image = $userImage;
                }

                if(!$user->id){
                    $user->id = $user->save();
                    if($user->id > 0) $response->create(200, "Success.", $user->to_valid_array());
                    else $response->create(201, "Something Went Wrong. Please try Again.", null);
                }else{
                    if($user->where(["id"=>$user->id])->update()) $response->create(200, "Success.", $user->to_valid_array());
                }

                if($user) {
                    $response->create(200, "Success", $user->to_valid_array());
                }else $response->create(201, "Invalid User", null);
            }else $response->create(201, "Invalid Parameter", null);
        }else $response->create(201, "Invalid Api Token", null);
    }else $response->create(201, "No Api Token Found", null);
}else $response->create(201, "Invalid Request Method", null);

echo $response->print_response();

?>
