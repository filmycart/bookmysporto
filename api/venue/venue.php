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
                $venues = new Venue();
               
                $sort_by = "id";
                $sort_type = "desc";        

                $column = "";
                $column = "venue.id AS venueId, venue.title AS venueTitle, venue.description AS venueDescription, venue.is_featured AS isFeatured, venue.address AS venuAddress, venue.owner AS venueOwner, venue.image AS venueImage, venue.state AS venueState, venue.city AS venueCity, venue.country AS venueCountry, venue.status AS venueStatus, venue.admin_id AS venueAdminId, ";
                $column .= "countries.id AS countryId, countries.shortname AS countryShortName, countries.name AS countryName, countries.phonecode AS countryPhoneCode, ";
                $column .= "state.id AS stateId, state.name AS stateName, state.country_id AS stateCountryId, ";
                $column .= "city.id AS cityId, city.name AS cityName, city.state_id AS cityCountryId ";

                $joinColumn['join_table_name1'] = "venue";
                $joinColumn['join_table_name2'] = "countries";
                $joinColumn['join_table_name3'] = "state";
                $joinColumn['join_table_name4'] = "city";
                $joinColumn['join_column_name1'] = "country";
                $joinColumn['join_column_name2'] = "state";
                $joinColumn['join_column_name3'] = "city";
                $joinColumn['join_column_child'] = "id";

                $all_venues = (array) $venues->where(["admin_id" => 1])->orderBy($sort_by)->orderType($sort_type)->allWithJoin($column, $joinColumn);
            
                $venueArray = array();
                if(!empty($all_venues)) {
                    foreach($all_venues as $key=>$venueVal) {
                        $venueArray[$key]['id'] = $venueVal->venueId;
                        $venueArray[$key]['title'] = $venueVal->venueTitle;
                        $venueArray[$key]['description'] = $venueVal->venueDescription;
                        $venueArray[$key]['address'] = $venueVal->venuAddress;
                        $venueArray[$key]['isFeatured'] = $venueVal->isFeatured;
                        $venueArray[$key]['venueOwner'] = $venueVal->venueOwner;
                        $venueArray[$key]['venueImage'] = $venueVal->venueImage;
                        $venueArray[$key]['status'] = $venueVal->venueStatus;
                        $venueArray[$key]['countryName'] = $venueVal->countryName;
                        $venueArray[$key]['stateName'] = $venueVal->stateName;
                        $venueArray[$key]['cityName'] = $venueVal->cityName;
                    }
                }

                if (!empty($venueArray)) $response->create(200, "Success.", $venueArray);
                else $response->create(200, "No Item Found.", []);

            }else $response->create(201, "Invalid Api Token", null);
        }else $response->create(201, "No Api Token Found", null);
    }else $response->create(201, "Invalid Request Method", null);

    echo $response->print_response();
?>