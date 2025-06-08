<?php require_once('../../admin/private/init.php'); ?>

<?php
    $response = new Response();
    $errors = new Errors();

    if(Helper::is_post()){

        $api_token = Helper::post_val("api_token");

        if($api_token){
            $setting = new Setting();
            $setting = $setting->where(["api_token" => $api_token])->one();

            if(!empty($setting)){
                $venue = new Venue();
                $venue = $venue
                            ->where(["status" => '1'])
                            ->all();

                $venueArray = array();
                if(!empty($venue)) {
                    foreach($venue as $key=>$venueVal) {
                        $venueArray[$key]['id'] = $venueVal->id;
                        $venueArray[$key]['title'] = $venueVal->title;
                        $venueArray[$key]['address'] = $venueVal->address;
                        $venueArray[$key]['is_featured'] = $venueVal->is_featured;
                        $venueArray[$key]['status'] = $venueVal->status;
                    }
                }

                if (!empty($venueArray)) $response->create(200, "Success.", $venueArray);
                else $response->create(200, "No Item Found.", []);

            }else $response->create(201, "Invalid Api Token", null);
        }else $response->create(201, "No Api Token Found", null);
    }else $response->create(201, "Invalid Request Method", null);

    echo $response->print_response();
?>