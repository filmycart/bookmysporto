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
                $eventType = new Event_Type();
                
                $sort_by = "id";
                $sort_type = "desc";        

                $column = "";
                $column = "event_type.id AS eventTypeId, event_type.name AS eventTypeName, event_type.status AS eventTypeStatus ";
                $joinColumn['join_table_name1'] = "event_type";
                $joinColumn['join_column_child'] = "id";

                $all_event_type = (array) $eventType->where(["admin_id" => 1])->orderBy($sort_by)->orderType($sort_type)->allWithJoinOneTable($column, $joinColumn);
            
                $eventsTypeArray = array();
                if(!empty($all_event_type)){
                    foreach($all_event_type as $key=>$evenTypeVal){
                        $eventsTypeArray[$key]['eventTypeId'] = $evenTypeVal->eventTypeId;
                        $eventsTypeArray[$key]['eventTypeName'] = $evenTypeVal->eventTypeName;

                        $eventTypeStatus = "In-Active";
                        if($evenTypeVal->eventTypeStatus == 1){
                            $eventTypeStatus = "Active";
                        } elseif($evenTypeVal->eventTypeStatus == 2){
                            $eventTypeStatus = "In-Active";
                        }

                        $eventsTypeArray[$key]['eventTypeStatus'] = $eventTypeStatus;
                    }
                }

                if (!empty($eventsTypeArray)) $response->create(200, "Success.", $eventsTypeArray);
                else $response->create(200, "No Item Found.", []);
            }else $response->create(201, "Invalid Api Token", null);
        }else $response->create(201, "No Api Token Found", null);
    }else $response->create(201, "Invalid Request Method", null);

    echo $response->print_response();
?>