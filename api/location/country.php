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
            $countries = new Countries();
            $state = new State();
            $city = new City();

                $countries = $countries->where(["id" => "101"])->all();
                $state = $state->where(["country_id" => $countries['0']->id])->all();
                $city = $city->all();

                $cityArray = array();
                if(!empty($city)) {
                    foreach($city as $key4=>$cityVal) {

                        $cityArray[$cityVal->state_id]['id'][$key4] = $cityVal->id;
                        $cityArray[$cityVal->state_id]['name'][$key4] = $cityVal->name;
                        $cityArray[$cityVal->state_id]['state_id'][$key4] = $cityVal->state_id;
/*
                        print"<pre>";
                        print_r($cityArray);
                        exit;*/

                        /*$cityArray[$cityVal['state_id']]['id'][$key4] = $cityVal['id'];
                        $cityArray[$cityVal['state_id']]['name'][$key4] = $cityVal['name'];
                        $cityArray[$cityVal['state_id']]['state_id'][$key4] = $cityVal['state_id'];*/


                        /*$city = $city->where(["state_id" => $stateIdVal])->all();

                        if(!empty($city)) {
                            foreach($city as $key3=>$cityVal) {
                                $locationArray[$countriesVal->id]['city'][$key3]['id'] = $cityVal['id'];
                                $locationArray[$countriesVal->id]['city'][$key3]['name'] = $cityVal['name'];
                                $locationArray[$countriesVal->id]['city'][$key3]['state_id'] = $cityVal['state_id'];
                            }
                        }*/
                    }
                }


              /*  print"<pre>";
                print_r($cityArray);
                exit;*/


                $stateIdArray = array();
                if(!empty($state)) {
                    foreach($state as $key2=>$stateVal) {
                        $stateIdArray[] = $stateVal->id;
                    }
                }

                /*print"<pre>";
                print_r($stateIdArray);
                exit;*/

                $stateIdStr = "";
                if(!empty($stateIdArray)) {
                    //$stateIdStr = "'".implode("','",$stateIdArray)."'";
                    //$stateIdStr = implode("','",$stateIdArray);
                    //$stateIdStr = implode(",",$stateIdArray);
                }

                /*echo $stateIdStr;
                exit;*/

               /* $city = $city->whereIn(["state_id" => $stateIdStr])->all();

                print"<pre>";
                print_r($city);
                exit;*/

                $locationArray = array();
                if(!empty($countries)) {
                    foreach($countries as $countriesVal) {
                        $locationArray[$countriesVal->id]['id'] = $countriesVal->id;
                        $locationArray[$countriesVal->id]['shortname'] = $countriesVal->shortname;
                        $locationArray[$countriesVal->id]['name'] = $countriesVal->name;
                        $locationArray[$countriesVal->id]['phonecode'] = $countriesVal->phonecode;

                        if(!empty($state)) {
                            foreach($state as $key2=>$stateVal) {
                                $locationArray[$countriesVal->id]['state'][$key2]['id'] = $stateVal->id;
                                $locationArray[$countriesVal->id]['state'][$key2]['name'] = $stateVal->name;
                                $locationArray[$countriesVal->id]['state'][$key2]['country_id'] = $stateVal->country_id;
                            
                                if(!empty($cityArray[$stateVal->id])) {
                                    foreach($cityArray[$stateVal->id] as $key5=>$cityVal2) {
                                        $locationArray[$stateVal->id]['city'][$key5]['id'] = $cityVal2->id;
                                        $locationArray[$stateVal->id]['city'][$key5]['name'] = $cityVal2->name;
                                        $locationArray[$stateVal->id]['city'][$key5]['state_id'] = $cityVal2->state_id;
                                    }
                                }
                            }
                        }

                        /*if(!empty($stateIdArray)) {
                            foreach($stateIdArray as $stateIdVal) {
                                if(!empty($city)) {
                                    foreach($city as $key3=>$cityVal) {
                                        $locationArray[$countriesVal->id]['city'][$key3]['id'] = $cityVal['id'];
                                        $locationArray[$countriesVal->id]['city'][$key3]['name'] = $cityVal['name'];
                                        $locationArray[$countriesVal->id]['city'][$key3]['state_id'] = $cityVal['state_id'];
                                    }
                                }
                            }
                        }*/

                        /*print"<pre>";
                        print_r($countriesVal->name);
                        exit;*/

                    }
                }

                if (!empty($countries)) $response->create(200, "Success.", $locationArray);
                else $response->create(200, "No Item Found.", []);

            //}else $response->create(201, "Invalid Parameter", null);
        }else $response->create(201, "Invalid Api Token", null);
    }else $response->create(201, "No Api Token Found", null);
}else $response->create(201, "Invalid Request Method", null);

echo $response->print_response();

?>