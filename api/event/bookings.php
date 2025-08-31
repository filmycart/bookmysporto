<?php 
    require_once('../../admin/private/init.php'); 
    
    $pgId = "";
    $pgId = Helper::post_val("id");

    $response = new Response();
    $errors = new Errors();

    $myBookingData = array();

    if((Helper::is_post())){

        $api_token = Helper::post_val("api_token");

        if($api_token){
            $setting = new Setting();
            $setting = $setting->where(["api_token" => $api_token])->one();

            if(!empty($setting)) {
                $booking = new Bookings();

                $column = "";
                $column = "bookings.id AS bookingId, bookings.player_name AS bookingPlayerName, bookings.player_phone_number AS bookingPlayerPhoneNumber, bookings.player_name AS bookingPlayerName, bookings.event_id AS bookingEventId, bookings.venue_id AS bookingVenueId, bookings.user_id AS bookingUserId, bookings.status AS bookingStatus, bookings.booking AS bookingBooking, bookings.total_amount AS bookingTotalAmount, bookings.created AS bookingCreated, ";
                $column .= "event.id AS eventId, event.title AS eventTitle, event.description AS eventDescription, event.venue AS eventVenue, event.address AS eventAddress, event.start_date AS eventStartDate, event.end_date AS eventEndDate, event.state_id AS eventState, event.city_id AS eventCityId, event.country_id AS eventCountryId, event.type_id AS eventTypeId, event.category_id AS eventCategoryId, event.category_type_id AS eventCategoryTypeId, event.sub_category_id AS eventSubCategoryId, event.image_name AS eventImageName, event.status AS eventStatus, event.admin_id AS eventAdminId, ";
                $column .= "venue.id AS venueId, venue.title AS venueTitle, venue.description AS venueDescription, venue.address AS venueAddress, venue.state AS venueStateId, venue.city AS venueCity, venue.country AS venueCountry, venue.is_featured AS venueIsFeatured, venue.owner AS venueOwner, venue.image AS venueImage, venue.status AS venueStatus ";

                $joinColumn['join_table_name1'] = "bookings";
                $joinColumn['join_table_name2'] = "event";
                $joinColumn['join_table_name3'] = "venue";

                $joinColumn['join_column_name1'] = "event_id";
                $joinColumn['join_column_name2'] = "venue_id";
                $joinColumn['join_column_city_state_country_id'] = "id";
                
                $myBookingData = (array) $booking->where(["bookings.user_id" => $pgId])->allWithJoinThreeTables($column, $joinColumn);

                $response->create(200, "Success", $myBookingData);
            }else $response->create(201, "Invalid Api Token", null);
        }else $response->create(201, "No Api Token Found", null);
    }else $response->create(201, "Invalid Request Method", null);

    echo $response->print_response();
?>