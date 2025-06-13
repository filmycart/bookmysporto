<?php require_once('../../admin/private/init.php'); ?>

<?php
    $response = new Response();
    $errors = new Errors();

    if(Helper::is_post()){

        $api_token = Helper::post_val("api_token");

        if($api_token){
            $setting = new Setting();
            $setting = $setting->where(["api_token" => $api_token])->one();

            $sid = Helper::post_val("state_id");

            if(!empty($setting)) {
                $state = new State();
                $state = $state
                            ->where(["country_id" => '101'])
                            ->andWhere(["status" => '1'])
                            ->all();

                $stateArray = array();
                if(!empty($state)) {
                    foreach($state as $key=>$stateVal) {
                        $stateArray[$key]['id'] = $stateVal->id;
                        $stateArray[$key]['name'] = $stateVal->name;
                        $stateArray[$key]['countryId'] = $stateVal->country_id;
                        $stateArray[$key]['status'] = $stateVal->status;
                    }
                }

                if (!empty($stateArray)) $response->create(200, "Success.", $stateArray);
                else $response->create(200, "No Item Found.", []);

            }else $response->create(201, "Invalid Api Token", null);
        }else $response->create(201, "No Api Token Found", null);
    }else $response->create(201, "Invalid Request Method", null);

    echo $response->print_response();
?>