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

                $column = "";
                $column = "event.id AS eventId, event.title AS eventTitle, event.description AS eventDescription, event.venue AS eventVenue, event.address AS eventAddress, event.start_date AS eventStartDate, event.end_date AS eventEndDate, event.state_id AS eventState, event.city_id AS eventCityId, event.country_id AS eventCountryId, event.type_id AS eventTypeId, event.category_id AS eventCategoryId, event.category_type_id AS eventCategoryTypeId, event.sub_category_id AS eventSubCategoryId, event.image_name AS eventImageName, event.status AS eventStatus, event.admin_id AS eventAdminId, ";
                $column .= "countries.id AS countryId, countries.shortname AS countryShortName, countries.name AS countryName, countries.phonecode AS countryPhoneCode, ";
                $column .= "state.id AS stateId, state.name AS stateName, state.country_id AS stateCountryId, ";
                $column .= "city.id AS cityId, city.name AS cityName, city.state_id AS cityCountryId, ";
                $column .= "venue.id AS venueId, venue.title AS venueTitle, venue.description AS venueDescription, venue.address AS venueAddress, venue.state AS venueStateId, venue.city AS venueCity, venue.country AS venueCountry, venue.is_featured AS venueIsFeatured, venue.owner AS venueOwner, venue.image AS venueImage, venue.status AS venueStatus ";

                $joinColumn['join_table_name1'] = "event";
                $joinColumn['join_table_name2'] = "countries";
                $joinColumn['join_table_name3'] = "state";
                $joinColumn['join_table_name4'] = "city";
                $joinColumn['join_table_name5'] = "venue";

                $joinColumn['join_column_name1'] = "country_id";
                $joinColumn['join_column_name2'] = "state_id";
                $joinColumn['join_column_name3'] = "city_id";
                $joinColumn['join_column_name4'] = "venue";
                $joinColumn['join_column_city_state_country_id'] = "id";
                
                $all_events = (array) $events->where(["event.admin_id" => 1])->allWithJoin($column, $joinColumn);
            
                $eventsArray = array();
                if(!empty($all_events)) {
                    foreach($all_events as $key=>$eventVal) {
                        $eventsArray[$key]['eventId'] = $eventVal->eventId;
                        $eventsArray[$key]['eventTitle'] = $eventVal->eventTitle;
                        $eventsArray[$key]['eventDescription'] = (isset($eventVal->eventDescription)?$eventVal->eventDescription:'');                        
                        $eventsArray[$key]['eventVenue'] = $eventVal->eventVenue;
                        $eventsArray[$key]['eventAddress'] = $eventVal->eventAddress;
                        $eventsArray[$key]['eventStartDate'] = $eventVal->eventStartDate;
                        $eventsArray[$key]['eventEndDate'] = $eventVal->eventEndDate;
                        $eventsArray[$key]['eventImage'] = $eventVal->eventImageName;
                        $eventsArray[$key]['eventStatus'] = $eventVal->eventStatus;
                        $eventsArray[$key]['countryName'] = $eventVal->countryName;
                        $eventsArray[$key]['stateName'] = $eventVal->stateName;
                        $eventsArray[$key]['cityName'] = $eventVal->cityName;

                        $eventStatus = "In-Active";
                        if($eventVal->eventStatus == 1){
                            $eventStatus = "Active";
                        } elseif($eventVal->eventStatus == 2){
                            $eventStatus = "In-Active";
                        }

                        $eventsArray[$key]['eventStatus'] = $eventStatus;
                    }
                }

                if (!empty($eventsArray)) $response->create(200, "Success.", $eventsArray);
                else $response->create(200, "No Item Found.", []);

            }else $response->create(201, "Invalid Api Token", null);
        }else $response->create(201, "No Api Token Found", null);
    }else $response->create(201, "Invalid Request Method", null);

    echo $response->print_response();
?>