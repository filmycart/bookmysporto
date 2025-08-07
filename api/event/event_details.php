<?php require_once('../../admin/private/init.php'); ?>

<?php
    $response = new Response();
    $errors = new Errors();

    $pgEventId = "";

    $pgEventId = Helper::post_val("id");

    if((Helper::is_post()) && (!empty($pgEventId))){

        $api_token = Helper::post_val("api_token");

        if($api_token){
            $setting = new Setting();
            $setting = $setting->where(["api_token" => $api_token])->one();

            if(!empty($setting)) {
                $event = new Event();
                
                $sort_by = "event.id";
                $sort_type = "event.desc";        

                $column = "";
                $column = "event.id AS eventId, event.title AS eventTitle, event.description AS eventDescription, event.venue AS eventVenue, event.address AS eventAddress, event.start_date AS eventStartDate, event.end_date AS eventEndDate, event.image_name AS eventImage, event.status AS eventStatus, event.state_id AS eventState, event.city_id AS eventCity, event.country_id AS eventCountry, event.admin_id AS eventAdminId, ";
                $column .= "countries.id AS countryId, countries.shortname AS countryShortName, countries.name AS countryName, countries.phonecode AS countryPhoneCode, ";
                $column .= "state.id AS stateId, state.name AS stateName, state.country_id AS stateCountryId, ";
                $column .= "city.id AS cityId, city.name AS cityName, city.state_id AS cityCountryId, ";
                $column .= "venue.id AS venueId, venue.title AS venueTitle, venue.description AS venueDescription, venue.status AS venueStatus, venue.address AS venueAddress, venue.state AS venueState, venue.city AS venueCity, venue.lat AS venueLat, venue.lon AS venueLon, venue.is_featured AS venueIsFeatured, venue.owner AS venueOwner ";

                $joinColumn['join_table_name1'] = "event";
                $joinColumn['join_table_name2'] = "countries";
                $joinColumn['join_table_name3'] = "state";
                $joinColumn['join_table_name4'] = "city";
                $joinColumn['join_table_name5'] = "venue";
                $joinColumn['join_column_name1'] = "country_id";
                $joinColumn['join_column_name2'] = "state_id";
                $joinColumn['join_column_name3'] = "city_id";
                $joinColumn['join_column_name4'] = "venue";
                $joinColumn['join_column_child'] = "id";

                $eventDetail = (array) $event->where(["event.id" => $pgEventId])->orderBy($sort_by)->orderType($sort_type)->allWithJoinSingle($column, $joinColumn);
                    
                 if (!empty($eventDetail)) $response->create(200, "Success.", $eventDetail);
                else $response->create(200, "No Item Found.", []);

            }else $response->create(201, "Invalid Api Token", null);
        }else $response->create(201, "No Api Token Found", null);
    }else $response->create(201, "Invalid Request Method", null);

    echo $response->print_response();
?>