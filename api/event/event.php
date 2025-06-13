<?php require_once('../../admin/private/init.php'); ?>

<?php
    $response = new Response();
    $errors = new Errors();

    if(Helper::is_post()){

        $api_token = Helper::post_val("api_token");

        if($api_token){
            $setting = new Setting();
            $setting = $setting->where(["api_token" => $api_token])->one();

            if(!empty($setting)) {
                $events = new Event();
                
                $sort_by = "id";
                $sort_type = "desc";        

                $column = "";
                $column = "event.id AS eventId, event.title AS eventTitle, event.venue AS eventVenue, event.address AS eventAddress, event.start_date AS eventStartDate, event.end_date AS eventEndDate, event.image_name AS eventImage, event.status AS eventStatus, event.state_id AS eventState, event.city_id AS eventCity, event.country_id AS eventCountry, event.admin_id AS eventAdminId, ";
                $column .= "countries.id AS countryId, countries.shortname AS countryShortName, countries.name AS countryName, countries.phonecode AS countryPhoneCode, ";
                $column .= "state.id AS stateId, state.name AS stateName, state.country_id AS stateCountryId, ";
                $column .= "city.id AS cityId, city.name AS cityName, city.state_id AS cityCountryId ";

                $joinColumn['join_table_name1'] = "event";
                $joinColumn['join_table_name2'] = "countries";
                $joinColumn['join_table_name3'] = "state";
                $joinColumn['join_table_name4'] = "city";
                $joinColumn['join_column_name1'] = "country_id";
                $joinColumn['join_column_name2'] = "state_id";
                $joinColumn['join_column_name3'] = "city_id";
                $joinColumn['join_column_child'] = "id";

                $all_events = (array) $events->where(["admin_id" => 1])->orderBy($sort_by)->orderType($sort_type)->allWithJoin($column, $joinColumn);
            
                $eventsArray = array();
                if(!empty($all_events)) {
                    foreach($all_events as $key=>$eventVal) {
                        $eventsArray[$key]['eventId'] = $eventVal->eventId;
                        $eventsArray[$key]['eventTitle'] = $eventVal->eventTitle;
                        $eventsArray[$key]['eventVenue'] = $eventVal->eventVenue;
                        $eventsArray[$key]['eventAddress'] = $eventVal->eventAddress;
                        $eventsArray[$key]['eventStartDate'] = $eventVal->eventStartDate;
                        $eventsArray[$key]['eventEndDate'] = $eventVal->eventEndDate;
                        $eventsArray[$key]['eventImage'] = $eventVal->eventImage;
                        $eventsArray[$key]['eventStatus'] = $eventVal->eventStatus;
                        $eventsArray[$key]['countryName'] = $eventVal->countryName;
                        $eventsArray[$key]['stateName'] = $eventVal->stateName;
                        $eventsArray[$key]['cityName'] = $eventVal->cityName;
                    }
                }

                if (!empty($eventsArray)) $response->create(200, "Success.", $eventsArray);
                else $response->create(200, "No Item Found.", []);

            }else $response->create(201, "Invalid Api Token", null);
        }else $response->create(201, "No Api Token Found", null);
    }else $response->create(201, "Invalid Request Method", null);

    echo $response->print_response();
?>